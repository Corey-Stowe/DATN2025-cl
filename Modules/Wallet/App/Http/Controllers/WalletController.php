<?php

namespace Modules\Wallet\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Trx_history;
use App\Models\Trx_history_detail;
use App\Models\Vnpay;
use App\Models\Wallet;
use App\Models\Webautn;
use App\Models\Withdraw;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;
use Exception;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wallet = new Wallet();
        $user_id = auth()->user()->id;
        $data = $wallet->getWallet($user_id);
        $wallet_account_id = $data->wallet_account_id;
        $trx_history = new Trx_history();
        $trx_data = $trx_history->get20trx($wallet_account_id);
        $withdraw = new Withdraw();
        $withdraw_toal = $withdraw->countAmmountPed($wallet_account_id);
        return view('wallet::index', compact('data', 'trx_data', 'withdraw_toal'));
    }
    public function topup()
    {
        return view('wallet::trans.topup');
    }
    public function charge(Request $request)
{
    $wallet = new Wallet();
    $user_id = auth()->user()->id;
    $data = $wallet->getWallet($user_id);
    if($data->wallet_user_level == 1){
        return redirect()->back()->with('error', 'Tài khoản của bạn chưa được xác thực');
    }
    if($data->wallet_status != 1){
        return redirect()->back()->with('error', 'Ví tiền của bạn đã bị vô hiệu hóa');
    }
    $decimal_Ammount = $request->ammount;

    // Remove dots and convert to integer
    $decimal_Ammount = str_replace('.', '', $decimal_Ammount);

    if (!is_numeric($decimal_Ammount)) {
        return redirect()->back()->with("error", "Invalid amount value.");
    }

    // Format to integer
    $intammount = intval($decimal_Ammount /10);

    $new_Payment = new Vnpay();
    try {
        $new_Payment->create_payment($intammount, "vn");
    } catch (\Exception $e) {
        return redirect()->back()->with("error", $e->getMessage());
    }
}
    public function callbackvnpaydata()
    {
        $user_id = Auth::user()->id;
        $wallet = new Wallet();
        $walletaccount = $wallet->getWallet($user_id);
        $wallet_account_id = $walletaccount->wallet_account_id;


        $returndata = [
            'Ammout' => $_GET['vnp_Amount'],
            'Bankcode' => $_GET['vnp_BankCode'],
            'vnp_BankTranNo' => isset($_GET['vnp_BankTranNo']) ? $_GET['vnp_BankTranNo'] : "",
            'vnp_CardType' => $_GET['vnp_CardType'],
            'vnp_PayDate' => $_GET['vnp_PayDate'],
            'vnp_ResponseCode' => $_GET['vnp_ResponseCode'],
            'vnp_TransactionNo' => $_GET['vnp_TransactionNo'],
            'vnp_TransactionStatus' => $_GET['vnp_TransactionStatus'],
            'vnp_TxnRef' => $_GET['vnp_TxnRef'],
            'vnp_SecureHash' => $_GET['vnp_SecureHash'],
        ];
        $hashcheck = new Trx_history();
        $data = $hashcheck->checkHash($_GET['vnp_SecureHash']);
        if ($data == false) {
            if ($_GET['vnp_ResponseCode'] == 00) {
             //   dd('Thanh toan thanh cong');
                $data = [
                    'wallet_account_id' => $wallet_account_id,
                    'trx_type' => "topup",
                    'trx_from' => "vnpay",
                    'trx_to' => "wallet",
                    'trx_amount' => ($_GET['vnp_Amount'] / 100),
                    'trx_balance_available' => $walletaccount->wallet_balance_available + ($_GET['vnp_Amount'] / 100),
                    'trx_hash_request' => $_GET['vnp_SecureHash'],
                    'trx_status' => 1,
                    'created_at' => $_GET['vnp_PayDate'],
                    'updated_at' => $_GET['vnp_PayDate']
                ];
                try {
                    $trx = new Trx_history();
                    $trx->createTrx($data);
                    if ($trx) {
                        $trx_id = $trx->getLasttrxid();
                        $trx_lastid = $trx_id->trx_id;
                        $data_trx_detail = [
                            'trx_id' => $trx_lastid,
                            'trx_detail_desc' => "Nap tien qua VNPAY",
                            'trx_date_issue' => $_GET['vnp_PayDate'],
                            'vnp_BankTranNo' => $_GET['vnp_BankTranNo'],
                            'vnp_SecureHash' => $_GET['vnp_SecureHash'],
                            'vnp_ResponseCode' => $_GET['vnp_ResponseCode'],
                            'vnp_TxnRef' => $_GET['vnp_TxnRef'],
                            'vnp_TransactionNo' => $_GET['vnp_TransactionNo'],
                            'vnp_PayDate' => $_GET['vnp_PayDate'],
                            'vnp_CardType' => $_GET['vnp_CardType'],
                            'BankCode' => $_GET['vnp_BankCode'],
                        ];
                        $trx_detail = new Trx_history_detail();
                        $trx_detail->createTrxDetail($data_trx_detail);
                        if ($trx_detail) {
                            $wallet->addBalance($wallet_account_id, $_GET['vnp_Amount'] / 100);
                            return view('wallet::transhistory.resultvnpay', compact('returndata'));
                        }
                    }
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            } else {
              //  dd('Thanh toan that bai');
                $data = [
                    'wallet_account_id' => $wallet_account_id,
                    'trx_type' => "topup",
                    'trx_from' => "vnpay",
                    'trx_to' => "wallet",
                    'trx_amount' => ($_GET['vnp_Amount'] / 100),
                    'trx_balance_available' => $walletaccount->wallet_balance_available,
                    'trx_hash_request' => $_GET['vnp_SecureHash'],
                    'trx_status' => 2,
                    'created_at' => $_GET['vnp_PayDate'],
                    'updated_at' => $_GET['vnp_PayDate']
                ];
                try {
                    $trx = new Trx_history();
                    $trx->createTrx($data);
                    if ($trx) {
                        $trx_id = $trx->getLasttrxid();
                        $trx_lastid = $trx_id->trx_id;
                        $data_trx_detail = [
                            'trx_id' => $trx_lastid,
                            'trx_detail_desc' => "Nap tien qua VNPAY",
                            'trx_date_issue' => $_GET['vnp_PayDate'],
                            'vnp_BankTranNo' => "FAILED",
                            'vnp_SecureHash' => $_GET['vnp_SecureHash'],
                            'vnp_ResponseCode' => $_GET['vnp_ResponseCode'],
                            'vnp_TxnRef' => $_GET['vnp_TxnRef'],
                            'vnp_TransactionNo' => $_GET['vnp_TransactionNo'],
                            'vnp_PayDate' => $_GET['vnp_PayDate'],
                            'vnp_CardType' => $_GET['vnp_CardType'],
                            'BankCode' => $_GET['vnp_BankCode'],
                        ];
                        $trx_detail = new Trx_history_detail();
                        $trx_detail->createTrxDetail($data_trx_detail);
                        if ($trx_detail) {
                            return view('wallet::transhistory.resultvnpay', compact('returndata'));
                        }
                    }
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
                return view('wallet::transhistory.resultvnpay', compact('returndata'));
            }
        } else {
            return view('wallet::transhistory.resultvnpay', compact('returndata'));
        }
        return view('wallet::transhistory.resultvnpay', compact('returndata'));
    }
    public function transaction($id)
    {
        $trans = new Trx_history();
        $data = $trans->trans_detail($id);
        if ($data->first()->withdraw_request_id == null) {
            $data_non_withdraw = $trans->trans_detail($id);
            return view('wallet::transhistory.detail', compact('data'));
        } else {
            $data = $trans->trans_detail_withdraw($id);
            return view('wallet::transhistory.detail', compact('data'));
        }
    }


    public function withdraw()
    {
        return view('wallet::trans.withdraw');
    }

    public function createWithdraw(Request $request){
        $wallet = new Wallet();
        $user_id = auth()->user()->id;
        $data = $wallet->getWallet($user_id);
        $wallet_account_id = $data->wallet_account_id;
        $WalletStastus = $wallet->getWalletStastus($wallet_account_id);
        $WalletLevel = $wallet->getWalletLevel($wallet_account_id);
        if($data->wallet_user_level == 1){
            return redirect()->back()->with('error', 'Tài khoản của bạn chưa được xác thực');
        }
        if($data->wallet_status != 1){
            return redirect()->back()->with('error', 'Ví tiền của bạn đã bị vô hiệu hóa');
        }

        // Remove any formatting characters and convert to integer
        $decimal_Ammount = str_replace(['.', ','], '', $request->amount);
        $decimal_Ammount = intval($decimal_Ammount);

        if($data->wallet_balance_available < $decimal_Ammount) {
           return back()->with('error', 'Số dư không đủ để thực hiện giao dịch');
        }

        if ($WalletStastus->wallet_status == 1){
            $withdraw = new Withdraw();
            //generate hash
            $key = env('VNP_HASH_SECRET'); // Replace with your actual secret key
            $hashmac = hash_hmac('sha512', $request->amount . $wallet_account_id . date('Y-m-d H:i:s'), $key);
            $withdraw_data = [
                "wallet_account_id" => $wallet_account_id,
                "amount" => $decimal_Ammount,
                "bank_account_number" => $request->bank_account_number,
                "bank_account_name" => $request->bank_account_name,
                "bank_name" => $request->bank_name,
                "request_date" => date('Y-m-d'),
                "status" => 1,
                "description" => "Withdraw request"
            ];
            $withdraw->createWithdraw($withdraw_data);
            if($withdraw){
                $withdraw_id = $withdraw->getlastwithdrawid()->withdraw_request_id; // Ensure this returns an integer
                $data_trx = [
                    'wallet_account_id' => $wallet_account_id,
                    'trx_type' => "Withdraw",
                    'trx_from' => "Account",
                    'trx_to' => "Bank",
                    'trx_amount' => $decimal_Ammount,
                    'trx_balance_available' => $data->wallet_balance_available - $decimal_Ammount,
                    'trx_hash_request' => $hashmac,
                    'trx_status' => 0,
                    'withdraw_request_id' => $withdraw_id, // Ensure this is an integer
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                try {
                    $trx = new Trx_history();
                    $trx->createTrx($data_trx);
                    if ($trx) {
                        $trx_id = $trx->getLasttrxid();
                        $trx_lastid = $trx_id->trx_id;
                        $data_trx_detail = [
                            'trx_id' => $trx_lastid,
                            'trx_detail_desc' => "Withdraw request",
                            'trx_date_issue' => date('Y-m-d H:i:s'),
                            'vnp_SecureHash' => $hashmac,
                        ];
                        $trx_detail = new Trx_history_detail();
                        $trx_detail->createTrxDetail($data_trx_detail);
                        if ($trx_detail) {
                           $wallet->takeBalance($wallet_account_id, $decimal_Ammount);
                            return redirect()->route('wallet.index')->with('success', 'Tạo yêu cầu rút tiền thành công');
                        }
                    }
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
        } else {
            return redirect()->route('wallet.index')->with('error', 'Ví tiền của bạn đã bị vô hiệu hóa');
        }
    }

    public function withdrawcanel($id){
        $data = [
            'status'=> 3,
            'admin_note'=> "Yêu cầu bị hủy bởi người dùng",
            'admin_response_date'=> date('Y-m-d H:i:s')
        ];
        $data_trx = [
            'trx_status' => 2,
            'updated_at' =>  date('Y-m-d H:i:s')
        ];
        $withdraw = new Withdraw();
        $data_wd = $withdraw->getwithdraw($id);
        dd($data_wd);
        $trx_id = $data_wd->trx_id;
        $ammount = $data_wd->amount;
        try{
           $data =  $withdraw->updatewithdraw($id, $data);
            if ($data){
                $trx = new Trx_history();
                $wallet = new Wallet();
                try{
                    $trx->updateTrx($trx_id, $data_trx);
                    $wallet->addBalance($data_wd->wallet_account_id, $ammount);
                    return back()->with('success', 'Yêu cầu đã được cập nhật');
                } catch(Exception $e){
                    dd($e);
                }

            }
        } catch(Exception $e){
            dd($e);
        }
    }

    public function profile(){
        $wallet = new Wallet();
        $user_id = auth()->user()->id;
        $data = $wallet->getWallet($user_id);
        $wallet_account_id = $data->wallet_account_id;
        $trx_history = new Trx_history();
        $trx_data = $trx_history->get20trx($wallet_account_id);
        $withdraw = new Withdraw();
        $webauthn = new Webautn();
        $webauth_data = $webauthn->getUserKey(auth()->user()->id);
        $withdraw_toal = $withdraw->countAmmountPed($wallet_account_id);
      //  dd($webauth_data);
        return view('wallet::profile.list   ', compact('data', 'trx_data', 'withdraw_toal','webauth_data'));
    }
}
