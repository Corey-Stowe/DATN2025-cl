<?php

namespace Modules\Client\App\Http\Controllers;


use App\Models\Order;
use Barryvdh\DomPDF\PDF;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use App\Models\Shipping;
use App\Models\OrderDetailModel;
use App\Models\Wallet;
use App\Models\Trx_history;
use App\Models\Trx_history_detail;
use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use App\Models\User;
use App\Notifications\ReciveTransferNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Exception;

class MyAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        return view('client::contents.auth.my-account', compact('user'));
    }

    public function getOrders(Request $request)
    {

        $perPage = 5;

        $orders = Order::where('users_id', auth()->id())->orderBy('created_at', 'desc')->paginate($perPage);

        $formattedOrders = $orders->getCollection()->map(function ($order) {

            $items_count = OrderDetailModel::where('order_id', $order->id)->count();
            $total_price = $order->total_price;
            return [
                'id' => $order->id,
                'date' => $order->created_at ? Carbon::parse($order->created_at)->format('d-m-Y') : null,
                'status' => $order->status_order,
                'total' => number_format($total_price, 0, ',', '.') . " VND cho {$items_count} sản phẩm"
            ];
        });


        return response()->json([
            'orders' => $formattedOrders,
            'pagination' => [
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'next_page_url' => $orders->nextPageUrl(),
                'prev_page_url' => $orders->previousPageUrl()
            ]
        ]);
    }

    public function getOrderDetails($id)
    {
        $order = Order::query()->where('users_id', auth()->id())->findOrFail($id);
        $orderItems = OrderDetail::query()
            ->with('productVariant')
            ->with("productVariant.size")
            ->with("productVariant.color")
            ->with("productVariant.product")
            ->where('order_id', $order->id)->get();

        // Biến chứa dữ liệu vận chuyển
        $shippingDetails = [];
        $deliveryDetails = [];

        if ($order->status_order == 'Đang giao hàng') {
            $shipping = new Shipping();
            $data_ship = $shipping->getShipping($order->id);
            $frist_location = $shipping->getOldestShipping($order->id);
            $last_location = $shipping->getLastUpdateShipping($order->id);

            // Chuẩn bị dữ liệu vận chuyển
            $shippingDetails = [
                'history' => $data_ship->map(function ($ship) {
                    return [
                        'updated_at' => $ship->updated_at,
                        'status' => $ship->status,
                        'location' => $ship->location,
                    ];
                }),
                'first_location' => $frist_location ? [
                    'location' => $frist_location->location,
                    'updated_at' => $frist_location->updated_at,
                ] : null,
                'last_location' => $last_location ? [
                    'location' => $last_location->location,
                    'updated_at' => $last_location->updated_at,
                ] : null,
            ];

            // Thêm thông tin giao hàng
            $deliveryDetails = [
                'shipping_method' => $order->shipping_method,
                'order_id' => $order->id,
                'current_status' => $last_location ? $last_location->status : 'Chưa có cập nhật',
            ];
        }

        // return response()->json([
        //     'id' => $order->id,
        //     'user_note' => $order->user_note,
        //     'status' => $order->status_order,
        //     'items' => $orderItems->map(function ($item) {
        //         return [
        //             'name' => $item->product_name,
        //             'image' => $item->product_avatar,
        //             'size' => $item->productVariant->size->size_value,
        //             'color' => $item->productVariant->color->color_value,
        //             'quantity' => $item->product_quantity,
        //             'price' => number_format($item->product_price_final, 2),
        //             'total' => number_format($item->product_quantity * $item->product_price_final, 2)
        //         ];
        //     }),
        //     'grand_total' => number_format($orderItems->sum(function ($item) {
        //         return $item->product_quantity * $item->product_price_final;
        //     }), 0, ',', '.') . ' VND',
        //     'discount' => number_format($order->discount, 0, ',', '.') . ' VND',
        //     'total' => number_format($order->total_price, 0, ',', '.') . ' VND',
        //     'shipping' => [
        //         'name' => $order->ship_user_name,
        //         'address' => $order->ship_user_address,
        //         'email' => $order->ship_user_email,
        //         'phone' => $order->ship_user_phone,
        //     ],
        //     'billing' => [
        //         'status_payment' => $order->status_payment,
        //         'payment_method' => $order->payment_method,
        //     ],
        //     'delivery' => $deliveryDetails,
        //     'shipping_details' => $shippingDetails,
        // ]);
       dd([
            'id' => $order->id,
            'user_note' => $order->user_note,
            'status' => $order->status_order,
            'items' => $orderItems->map(function ($item) {
                return [
                    'name' => $item->product_name,
                    'image' => $item->product_avatar,
                    'size' => $item->productVariant->size->size_value,
                    'color' => $item->productVariant->color->color_value,
                    'quantity' => $item->product_quantity,
                    'price' => number_format($item->product_price_final, 2),
                    'total' => number_format($item->product_quantity * $item->product_price_final, 2)
                ];
            }),
            'grand_total' => number_format($orderItems->sum(function ($item) {
                return $item->product_quantity * $item->product_price_final;
            }), 0, ',', '.') . ' VND',
            'discount' => number_format($order->discount, 0, ',', '.') . ' VND',
            'total' => number_format($order->total_price, 0, ',', '.') . ' VND',
            'shipping' => [
                'name' => $order->ship_user_name,
                'address' => $order->ship_user_address,
                'email' => $order->ship_user_email,
                'phone' => $order->ship_user_phone,
            ],
            'billing' => [
                'status_payment' => $order->status_payment,
                'payment_method' => $order->payment_method,
            ],
            'delivery' => $deliveryDetails,
            'shipping_details' => $shippingDetails,
        ]);
    }


    public function downloadPDF($id)
    {
        // Lấy dữ liệu đơn hàng cùng với các sản phẩm liên quan
        $order = Order::findOrFail($id);

        $orderItemsO = OrderDetail::query()
            ->with('productVariant')
            ->with("productVariant.size")
            ->with("productVariant.color")
            ->with("productVariant.product")
            ->where('order_id', $order->id)
            ->get();

        $orderItems = [];

        foreach ($orderItemsO as $item) {
            $orderItems[] = [
                'name' => $item->productVariant->product->name,
                'image' => $item->productVariant->product->image_avatar,
                'size' => $item->productVariant->size->size_value,
                'color' => $item->productVariant->color->color_value,
                'quantity' => $item->product_quantity,
                'price' => $item->product_price_final,
            ];
        }

        // Tạo PDF sử dụng view và dữ liệu
        $pdf = app(PDF::class)->loadView('client::emails.pdf', compact('order', 'orderItems'))->setOptions([
            'isRemoteEnabled' => true,
            'chroot' => public_path(),
        ]);

        // Đặt tên file tùy chỉnh
        $date = Carbon::parse($order->created_at)->format('d-m-Y');
        $fileName = 'hóa đơn -' . $order->id . '-' . Str::slug($order->user_name) . "-$date" . '.pdf';

        // Trả về PDF dưới dạng file tải về
        return $pdf->stream($fileName);
    }

    public function cancelOrder($id)
    {
        // thằng nào để enum bằng tiếng việt sv vl
        $order = Order::findOrFail($id);
        $status_payment = $order->status_payment;
        $payment_method = $order->payment_method;
        $status_order = $order->status_order;
        $toal_price = $order->total_price;
       // dd($order);
        if ($order->status_order !== 'Chờ xác nhận' && $order->status_order !== 'Đã xác nhận') {
            return response()->json([
                'message' => 'Chỉ có thể hủy đơn hàng ở trạng thái Chờ xác nhận hoặc Đã xác nhận.',
            ], 400);
        };
        if ($status_payment == 'Đã thanh toán') {
            if ($payment_method == 'Thanh toán ví tiền' || $payment_method == 'Thanh toán qua VNpay') {
                //refund
                $wallet = new Wallet();
                $trx = new Trx_history();
                $trx_detail = new Trx_history_detail();
                $user_wallet_data = $wallet->getWallet($order->users_id);
                $wallet_account_id = $user_wallet_data->wallet_account_id;
                if (empty($user_wallet_data)) {
                    return response()->json([
                        'message' => 'Bạn chưa đăng ký ví tiền, vui lòng đăng ký ví tiền điện tử để được hoàn tiền',
                    ], 400);
                } else {
                    $key = env('VNP_HASH_SECRET'); // Replace with your actual secret key
                    $hashmac = hash_hmac('sha512', $order->users_id . date('Y-m-d H:i:s'), $key);
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
                        'trx_detail_desc' => "Hoàn trả giao dịch đơn hàng #" . $order->id . " tại " . "PCV Fashion",
                        'trx_date_issue' => date('Y-m-d H:i:s'),
                        'vnp_SecureHash' => $hashmac,
                    ];
                    try {
                        $trx_detail = new Trx_history_detail();
                        $trx_detail->createTrxDetail($data_trx_detail);
                        $wallet->addBalance($wallet_account_id, $toal_price);
                        $noti_data = [
                            'user_name' => Auth::user()->full_name,
                            'amount' => $toal_price,
                            'trx_id' => $trx_lastid,
                            'request_time' => date('Y-m-d H:i:s'),
                            'request_id' => $hashmac,
                            'wallet_account_id' => $wallet_account_id,
                        ];
                        $user = User::find($order->users_id);
                        $user->notify(new ReciveTransferNotification($noti_data));
                        $orderDetails = OrderDetail::where('order_id', $order->id)->get();

                        foreach ($orderDetails as $item) {
                            ProductVariant::where('id', $item->product_variant_id)->increment('quantity', $item->product_quantity);
                        }

                        $order->status_order = 'Đơn hàng bị hủy';
                        $order->save();
                        return response()->json(['message' => 'Đơn hàng đã hủy thành công, Vui lòng đợi tiền về ví trong vòng 24h.'], 200);
                    } catch (Exception $e) {
                        return response()->json(['message' => $e->getMessage()], 400);
                    }
                }
            } //enum sv vl
        } else {
            $orderDetails = OrderDetail::where('order_id', $order->id)->get();

            foreach ($orderDetails as $item) {
                ProductVariant::where('id', $item->product_variant_id)->increment('quantity', $item->product_quantity);
            }

            $order->status_order = 'Đơn hàng bị hủy';
            $order->save();

            return response()->json(['message' => 'Đơn hàng được hủy thành công.'], 200);
        }
    }

    public function resetOrder($id)
    {
        $order = Order::findOrFail($id);

        // dd($order);



        if ($order->status_order !== 'Đơn hàng bị hủy') {
            return response()->json([
                'message' => 'Chỉ có thể đặt lại đơn hàng ở trạng thái hủy.',
            ], 400);
        }

        $orderDetails = OrderDetail::where('order_id', $order->id)->get();

        foreach ($orderDetails as $item) {
            ProductVariant::where('id', $item->product_variant_id)->decrement('quantity', $item->product_quantity);
        }

        $order->status_order = 'Chờ xác nhận';
        $order->save();

        return response()->json(['message' => 'Đơn hàng đã được đặt lại thành công.'], 200);
    }


    // Phương thức đánh dấu đơn hàng là đã nhận
    public function markAsReceived($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Đơn hàng không tồn tại'], 404);
        }

        // Kiểm tra trạng thái của đơn hàng có phải 'đang giao'
        if ($order->status_order != 'Đang giao hàng') {
            return response()->json(['message' => 'Đơn hàng không thể được đánh dấu là đã nhận'], 400);
        }

        // Cập nhật trạng thái của đơn hàng
        $order->status_order = 'Đã nhận hàng'; // Hoặc trạng thái bạn muốn
        $order->save();

        return response()->json(['message' => 'Đơn hàng đã được đánh dấu là đã nhận'], 200);
    }

    //chi tiết tài khoản
    // public function accountDetail(){
    //     $user = auth()->user();
    //     return view('client::contents.auth.my-account', compact('user'));
    // }
    /**
     * Show the form for creating a new resource.
     */
    public function changePassword(Request $request)
    {
        $messages = [
            'full_name.required' => 'Trường họ và tên là bắt buộc.',
            'full_name.string' => 'Trường họ và tên phải là một chuỗi ký tự.',
            'full_name.max' => 'Trường họ và tên không được vượt quá 255 ký tự.',
            'current_password.required' => 'Trường mật khẩu hiện tại là bắt buộc.',
            'new_password.required' => 'Trường mật khẩu mới là bắt buộc.',
            'new_password.string' => 'Mật khẩu mới phải là một chuỗi ký tự.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
            'new_password.confirmed' => 'Mật khẩu mới và xác nhận mật khẩu không khớp.',
            'new_password.regex' => 'Mật khẩu mới phải có ít nhất một chữ cái, một chữ số và một ký tự đặc biệt.',
            'new_password_confirmation.required_with' => 'Trường xác nhận mật khẩu mới là bắt buộc khi có mật khẩu mới.',
            'new_password_confirmation.same' => 'Xác nhận mật khẩu mới phải giống với mật khẩu mới.',
            'address.string' => 'Địa chỉ phải là một chuỗi ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
            'phone.required' => 'Trường số điện thoại là bắt buộc.',
            'phone.regex' => 'Số điện thoại phải là dãy số hợp lệ.',
            'phone.max' => 'Số điện thoại không được vượt quá 15 ký tự.',
        ];
    
        $rules = [
            'full_name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'required|regex:/^\d{10,15}$/|max:15',
        ];
    
        if ($request->new_password != null || $request->current_password != null) {
            $rules['current_password'] = 'required';
            $rules['new_password'] = 'required|string|min:8|confirmed|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/';
            $rules['new_password_confirmation'] = 'required_with:new_password|same:new_password';
        }
    
        $validator = Validator::make($request->all(), $rules, $messages);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $user = Auth::user();
    
        if ($request->new_password != null && !Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => 'Mật khẩu cũ không đúng.'], 400);
        }
    
        if ($request->new_password != null) {
            $user->password = Hash::make($request->new_password);
        }
        $user->full_name = $request->full_name;
    
        // Xử lý hình ảnh
        $filePath = $user->user_image; // Giữ nguyên hình ảnh cũ nếu có
        if ($request->hasFile('user_image')) {
            $filePath = $request->file('user_image')->store('/users_image', 'public');
    
            // Xóa hình cũ nếu có hình ảnh mới đẩy lên
            if ($user->user_image && Storage::disk('public')->exists($user->user_image)) {
                Storage::disk('public')->delete($user->user_image);
            }
        }
        $user->user_image = $filePath;
    
    
        $user->phone = $request->phone;
    
        if ($request->filled('address')) {
            $user->address = $request->address;
        }
    
        $user->save();
    
        return response()->json([
            'success' => true, 
            'message' => 'Thông tin đã được cập nhật thành công.',
            'user_image' => $user->user_image // Trả về đường dẫn hình ảnh mới
        ]);
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('index');
    }

    public function invoiceDetail($id)
    {
        $order = Order::query()->where('users_id', auth()->id())->findOrFail($id);
        $orderItems = OrderDetail::query()
            ->with('productVariant')
            ->with("productVariant.size")
            ->with("productVariant.color")
            ->with("productVariant.product")
            ->where('order_id', $order->id)->get();
            if($order->status_order == 'Đang giao hàng'){
                $shipping = new Shipping();
                $data_ship = $shipping->getShipping($order->id);
                $frist_location = $shipping->getOldestShipping($order->id);
                $last_location = $shipping->getLastUpdateShipping($order->id);
                return view('client::contents.shops.orderDetail', compact('order', 'orderItems','data_ship','frist_location','last_location'));
            }

        return view('client::contents.shops.orderDetail', compact('order', 'orderItems'));
    }
}
