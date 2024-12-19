<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\Wallet;
use App\Models\Trx_history;
use App\Models\Trx_history_detail;
use App\Models\OrderDetail;
use App\Models\ProductVariant;
use App\Notifications\ReciveTransferNotification;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listOrder()
    {
        $data = Order::query()->orderby("id", "desc")->paginate(20);
        $statusOrder = Order::STATUS_ORDER;
        $statusPayment = Order::STATUS_PAYMENT;
        return view('admin::contents.orders.orderlist', compact('data', 'statusOrder', 'statusPayment'));
    }
    public function orderDetail(Order $order)
    {
        $data = $order::query()->with('orderItems')->findOrFail($order->id);
        $statusOrder = Order::STATUS_ORDER;
        $statusPayment = Order::STATUS_PAYMENT;
        // dd($data);
        if ($data->status_order == 'Đang giao hàng') {
            $shipping = new Shipping();
            $data_ship = $shipping->getShipping($order->id);
            $frist_location = $shipping->getOldestShipping($order->id);
            $last_location = $shipping->getLastUpdateShipping($order->id);
            //dd($last_location );
            return view('admin::contents.orders.orderDetail', compact('data', 'statusOrder', 'statusPayment', 'data_ship', 'frist_location', 'last_location'));
        }
        return view('admin::contents.orders.orderDetail', compact('data', 'statusOrder', 'statusPayment'));
    }
    public function orderUpdate(Request $request, Order $order)
    {
        if (array_key_exists($request->status_order, Order::STATUS_ORDER)) {
            $data = $order::query()->findOrFail($order->id);
            if ($data->status_order == Order::STATUS_ORDER['shipping']) {
                return redirect()->back()->with(['error' => 'Cập nhật trạng thái không hợp lệ!']);
            }
            $data->update(['status_order' => Order::STATUS_ORDER[$request->status_order]]);
        } else {
            return redirect()->back()->with(['error' => 'Cập nhật trạng thái thất bại!']);
        }
        return redirect()->back()->with(['success' => 'Cập nhật trạng thái đơn hàng thành công!']);
    }

    public function cancelOrder(Request $request)
    {
        $order_id = $request->order_id;
        $note = $request->reason;
        $order = new Order();
        try {
            $orderDetails = OrderDetail::where('order_id', $order_id)->get();
            foreach ($orderDetails as $item) {
                ProductVariant::where('id', $item->product_variant_id)->increment('quantity', $item->product_quantity);
            }
            $order->cancelOrder($order_id);
            $order->adminNote($order_id, $note);
            return redirect()->back()->with(['success' => 'Cập nhật trạng thái đơn hàng thành công!']);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    public function cancelAndRefund(Request $request)
    {
        $order_id = $request->order_id;
        $note = $request->reason;
        $user_id = $request->user_id;
        $full_name = $request->full_name;
        $toal_price = $request->total_price;
        // dd($request->all());
        $wallet = new Wallet();
        $trx = new Trx_history();
        $trx_detail = new Trx_history_detail();
        $user_wallet_data = $wallet->getwalleuid($user_id);

        if(!empty($user_wallet_data)){
            $wallet_account_id = $user_wallet_data->wallet_account_id;
        }

        if (empty($user_wallet_data)) {
            $walletdata = [
                'user_id' => $user_id,
                'wallet_account_id' => random_int(100000,999999),
                'wallet_balance_available' => 0,
                'wallet_status' => 1,
                'wallet_user_level' => 1,

              ];
            $flags = $wallet->createWallet($walletdata);
            if ($flags) {
                $user_wallet_data = $wallet->getwalleuid($user_id);
                $wallet_account_id = $user_wallet_data->wallet_account_id;

                $key = env('VNP_HASH_SECRET'); // Replace with your actual secret key
                $hashmac = hash_hmac('sha512', $user_id . date('Y-m-d H:i:s'), $key);
                $data_trx = [
                    'wallet_account_id' => $wallet_account_id,
                    'trx_type' => "Transfer",
                    'trx_from' => "Shop",
                    'trx_to' => "Wallet",
                    'trx_amount' => $toal_price,
                    'trx_balance_available' => $user_wallet_data->wallet_balance_available + $toal_price,
                    'trx_hash_request' => $hashmac,
                    'trx_status' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $trx = new Trx_history();
                $trx->createTrx($data_trx);
                $trx_id = $trx->getLasttrxid();
                $trx_lastid = $trx_id->trx_id;
                $data_trx_detail = [
                    'trx_id' => $trx_lastid,
                    'trx_detail_desc' => "Hoàn trả giao dịch đơn hàng #" . $order_id . " tại " . "PCV Fashion",
                    'trx_date_issue' => date('Y-m-d H:i:s'),
                    'vnp_SecureHash' => $hashmac,
                ];
                try {
                    $user_wallet_data = $wallet->getwalleuid($user_id);
                    $wallet_account_id = $user_wallet_data->wallet_account_id;

                    $trx_detail = new Trx_history_detail();
                    $trx_detail->createTrxDetail($data_trx_detail);
                    $wallet->addBalance($wallet_account_id, $toal_price);
                    $noti_data = [
                        'user_name' => $full_name,
                        'amount' => $toal_price,
                        'trx_id' => $trx_lastid,
                        'request_time' => date('Y-m-d H:i:s'),
                        'request_id' => $hashmac,
                        'wallet_account_id' => $wallet_account_id,
                    ];
                    $order = new Order();
                    $orderDetails = OrderDetail::where('order_id', $order_id)->get();

                    foreach ($orderDetails as $item) {
                        ProductVariant::where('id', $item->product_variant_id)->increment('quantity', $item->product_quantity);
                    }
                    $order->cancelOrder($order_id);
                    $order->adminNote($order_id, $note);
                    $user = User::find($user_id);
                    $user->notify(new ReciveTransferNotification($noti_data));
                    return redirect()->back()->with(['success' => 'Hủy đơn hàng và hoàn tiền thành công!']);
                } catch (Exception $e) {
                    return redirect()->back()->with(['error' => $e->getMessage()]);
                }
            } else {
                return redirect()->back()->with(['error' => 'Tạo ví thất bại!']);
            }
        } else {
            $user_wallet_data = $wallet->getwalleuid($user_id);
            $wallet_account_id = $user_wallet_data->wallet_account_id;

            $key = env('VNP_HASH_SECRET'); // Replace with your actual secret key
            $hashmac = hash_hmac('sha512', $user_id . date('Y-m-d H:i:s'), $key);
            $data_trx = [
                'wallet_account_id' => $wallet_account_id,
                'trx_type' => "Transfer",
                'trx_from' => "Shop",
                'trx_to' => "Wallet",
                'trx_amount' => $toal_price,
                'trx_balance_available' => $user_wallet_data->wallet_balance_available + $toal_price,
                'trx_hash_request' => $hashmac,
                'trx_status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $trx = new Trx_history();
            $trx->createTrx($data_trx);
            $trx_id = $trx->getLasttrxid();
            $trx_lastid = $trx_id->trx_id;
            $data_trx_detail = [
                'trx_id' => $trx_lastid,
                'trx_detail_desc' => "Hoàn trả giao dịch đơn hàng #" . $order_id . " tại " . "PCV Fashion",
                'trx_date_issue' => date('Y-m-d H:i:s'),
                'vnp_SecureHash' => $hashmac,
            ];
            try {
                $trx_detail = new Trx_history_detail();
                $trx_detail->createTrxDetail($data_trx_detail);
                $wallet->addBalance($wallet_account_id, $toal_price);
                $noti_data = [
                    'user_name' => $full_name,
                    'amount' => $toal_price,
                    'trx_id' => $trx_lastid,
                    'request_time' => date('Y-m-d H:i:s'),
                    'request_id' => $hashmac,
                    'wallet_account_id' => $wallet_account_id,
                ];
                $order = new Order();
                $orderDetails = OrderDetail::where('order_id', $order_id)->get();

                foreach ($orderDetails as $item) {
                    ProductVariant::where('id', $item->product_variant_id)->increment('quantity', $item->product_quantity);
                }
                $order->cancelOrder($order_id);
                $order->adminNote($order_id, $note);
                $user = User::find($user_id);
                $user->notify(new ReciveTransferNotification($noti_data));
                return redirect()->back()->with(['success' => 'Hủy đơn hàng và hoàn tiền thành công!']);
            } catch (Exception $e) {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
        }
    }
    public function updateShip(Request $request)
    {
        if (empty($request->status)) {
            return redirect()->back()->with(['error' => 'Vui lòng chọn trạng thái giao hàng!']);
        }
        $data = [
            'order_id' => $request->order_id,
            'status' => $request->status,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'updated_at' => now(),
        ];
        //dd($data);
        try {
            $shipping = new Shipping();
            $shipping->updateShipping($data, $request->order_id);
            return redirect()->back()->with(['success' => 'Cập nhật trạng thái giao hàng thành công!']);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    public function createShip($id)
    {
        $shipping = new Shipping();
        $shipping->createShipping($id);
        $order = new Order();
        $order->setShipping($id);
        return redirect()->back()->with(['success' => 'Tạo trạng thái giao hàng thành công!']);

    }
    public function updatePayment(Order $order)
    {
        if ($order) {
            $order->update(['status_payment' => Order::STATUS_PAYMENT['paid']]);
            return redirect()->back()->with(['success' => 'Cập nhật thành công!']);
        } else {
            return redirect()->back()->with(['error' => 'Cập nhật thất bại!']);
        }
    }
}
