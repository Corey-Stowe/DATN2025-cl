<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use App\Models\Wallet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;
use App\Models\Trx_history;
use App\Models\UserEkyc;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $withdraw = new Withdraw();
         $data = $withdraw->listAllwithdraw();

       return view('admin::wallet.list', compact('data'));
    }

    public function withdraw($id){
        $withdraw = new Withdraw();
        $data = $withdraw->getwithdraw($id);
        $wallet_id  =  $data->wallet_account_id;
        $list_user = $withdraw->listwithdrawAccount5($wallet_id );
       //dd($data);
        return view('admin::wallet.detail', compact('data','list_user'));
    }
    public function updatepost(Request $request){
        $status = $request->status;
        $withdraw_request_id = $request->withdraw_request_id;
        $admin_note = $request->admin_note;
        $trx_id = $request->trx_id;
        $data = [
            'status'=> $status,
            'admin_note'=> $admin_note,
            'admin_response_date'=> date('Y-m-d H:i:s')
        ];
        $data_trx = [
            'trx_status' => 1,
            'updated_at' =>  date('Y-m-d H:i:s')
        ];
        $withdraw = new Withdraw();
        try{
           $data =  $withdraw->updatewithdraw($withdraw_request_id, $data);
            if ($data){
                $trx = new Trx_history();
                try{
                    $trx->updateTrx($trx_id, $data_trx);
                    return back()->with('success', 'Yêu cầu đã được cập nhật');
                } catch(Exception $e){
                    dd($e);
                }

            }
        } catch(Exception $e){
            dd($e);
        }

    }

    public function holdback(Request $request){
        $status = $request->status;
        $withdraw_request_id = $request->withdraw_request_id;
        $admin_note = $request->admin_note;
        $trx_id = $request->trx_id;
        $data = [
            'status'=> 4,
            'admin_note'=> $admin_note,
            'admin_response_date'=> date('Y-m-d H:i:s')
        ];
        $data_trx = [
            'trx_status' => 2,
            'updated_at' =>  date('Y-m-d H:i:s')
        ];
        $withdraw = new Withdraw();
        try{
           $data =  $withdraw->updatewithdraw($withdraw_request_id, $data);
            if ($data){
                $trx = new Trx_history();
                try{
                    $trx->updateTrx($trx_id, $data_trx);
                    return back()->with('success', 'Yêu cầu đã được cập nhật');
                } catch(Exception $e){
                    dd($e);
                }

            }
        } catch(Exception $e){
            dd($e);
        }

    }
    public function lockwallet(Request $request){
        $status = $request->status;
        $withdraw_request_id = $request->withdraw_request_id;
        $admin_note = $request->admin_note;
        $trx_id = $request->trx_id;
        $user_id = $request->user_id;
        $data_wallet = [
            'status'=> 3,
            'admin_note'=> $admin_note,
            'admin_response_date'=> date('Y-m-d H:i:s')
        ];
        $trx_data = [
            'trx_status' => 2,
            'updated_at' =>  date('Y-m-d H:i:s')
        ];
        $withdraw = new Withdraw();
        try{
           $data =  $withdraw->updatewithdraw($withdraw_request_id, $data_wallet);
            if ($data){
                try{
                    $wallet  = new Wallet();
                    $wallet ->setLockedWallet($request->wallet_id);
                    $wallet ->updateAdminNote($request->wallet_id, $admin_note);
                    return back()->with('success', 'Yêu cầu đã được cập nhật');
                } catch(Exception $e){
                    dd($e);
                }

            }
        } catch(Exception $e){
            dd($e);
        }

    }

    public function listallwallet(){
        $wallet = new Wallet();
        $data = $wallet->listAllWallet();
        //dd($data);
        return view('admin::wallet.listuser', compact('data'));
    }

    public function walletinfo($id){
        $wallet = new Wallet();
        $data = $wallet->getWalletInfo($id);
        $trx = new Trx_history();
        $data_trx = $trx->gettrxuser($id);
        //dd($data_trx);

        return view('admin::wallet.userdetal', compact('data','data_trx'));
    }
    public function setActive($id){
        $wallet = new Wallet();
        try{
            $wallet->setActiveWallet($id);
            return back()->with('success', 'Cập nhật thành công');
        } catch(Exception $e){
            dd($e);
        }

    }
    public function SetInActive($id){
        $wallet = new Wallet();
        try{
            $wallet->setInActiveWallet($id);
            return back()->with('success', 'Cập nhật thành công');
        } catch(Exception $e){
            dd($e);
        }

    }
    public function SetBasicUser($id){
        $wallet = new Wallet();
        try{
            $wallet->setLevelBasicWallet($id);
            return back()->with('success', 'Cập nhật thành công');
        } catch(Exception $e){
            dd($e);
        }

    }
     public function SetFullUser($id){
        $wallet = new Wallet();
        try{
            $wallet->setLevelFullWallet($id);
            return back()->with('success', 'Cập nhật thành công');
        } catch(Exception $e){
            dd($e);
        }

    }
    public function lockwalletUser(Request $request){
        $wallet = new Wallet();
        try{
            $wallet->setLockedWallet($request->wallet_id);
            if(isset($request->admin_note)){
                $wallet->updateAdminNote($request->wallet_id,$request->admin_note);
            }
            return back()->with('success', 'Cập nhật thành công');
        } catch(Exception $e){
            dd($e);
        }

    }


    public function SeachWithdraw(Request $request){
        $withdraw = new Withdraw();
        $data = $withdraw->seach($request->keywd);

        return view('admin::wallet.list', compact('data'));
    }

    public function listUserPending(){
        $ekyc = new UserEkyc();
        $data = $ekyc->listPedingUser();
      //  dd($data);
    return view('admin::wallet.lisUserPed', compact('data'));
    }

    public function userpedDetail($id)
    {
        //0
        $ekyc = new UserEkyc();
        $data = $ekyc->getUserKyc($id);
        //dd($data);
        //1
        $idcard_back = $data->id_card_image_back;
        $idcard_front = $data->id_card_image_front;
        //2
        $idcard_back_content = Storage::get($idcard_back );
        $idcard_front_content = Storage::get($idcard_front);
        //3
        $idcard_back_decode = Crypt::decrypt($idcard_back_content);
        $idcard_front_decode = Crypt::decrypt($idcard_front_content);
        //4
        $idcard_back_base64 = 'data:image/jpeg;base64,' . base64_encode($idcard_back_decode);
        $idcard_front_base64 = 'data:image/jpeg;base64,' . base64_encode($idcard_front_decode);

        return view('admin::wallet.userpedetail', compact('data', 'idcard_back_base64', 'idcard_front_base64'));

    }

    public function userpedUpdate(Request $request){
        if(empty($request->status)){
            return back()->withErrors(['status' => 'Vui lòng chọn trạng thái']);
        }

        if($request->status == 1){
            if(isset($request->admin_note)){
                $wallet = new Wallet();
                $wallet->updateAdminNote($request->wallet_account_id,$request->admin_note);
            }
            $ekyc = new UserEkyc();
            $ekyc->setStasusAprroved($request->id);

            $wallet = new Wallet();
            $wallet->setLevelFullWallet($request->wallet_account_id);
            return redirect()->route('admin.wallet.listUserPending')->with('success', 'Cập nhật thành công');

        } else if($request->status == 2){
            if(isset($request->admin_note)){
                $wallet = new Wallet();
                $wallet->updateAdminNote($request->wallet_account_id,$request->admin_note);
            }
            $ekyc = new UserEkyc();

                $ekyc->setfillekyc($request->id);

            $wallet = new Wallet();
            $wallet->setLevelBasicWallet($request->wallet_account_id);
            return redirect()->route('admin.wallet.listallwallet')->with('success', 'Cập nhật thành công');

        }


    }
    public function listwithdrawPed(){
        $withdraw = new Withdraw();
         $data = $withdraw->getListped();
         return view('admin::wallet.list', compact('data'));
    }
    public function listwithdrawapp(){
         $withdraw = new Withdraw();
         $data = $withdraw->getaproved();
         return view('admin::wallet.list', compact('data'));
    }
    public function listwithdrawrej(){
        $withdraw = new Withdraw();
        $data = $withdraw->getRejected();
        return view('admin::wallet.list', compact('data'));
   }
   public function SeachWallet(Request $request){
    $wallet = new Wallet();
    $data = $wallet->search($request->search);
    return view('admin::wallet.listuser', compact('data'));
   }
   public function SeachWalletPed(Request $request){
    $wallet = new Wallet();
    $data = $wallet->search($request->search);
    return view('admin::wallet.listuser', compact('data'));
   }

}

