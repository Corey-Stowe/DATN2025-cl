<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;
    protected $table = "withdraw_request";
    protected $fillable = [
        "withdraw_request_id",
        "wallet_account_id",
        "amount",
        "bank_account_number",
        "bank_account_name",
        "bank_name",
        "status",
        "description",
        "request_date",
        "admin_response_date",
        "admin_note"
    ];
    //1 - ped , 2 - approved , 3 - rejected


    public function countAmmountPed($wallet_account_id){
        return $this->where('wallet_account_id',$wallet_account_id)
        ->where('status',1)->orWhere('status',4)
        ->sum('amount');
    }

    public function createWithdraw($data){
        $withdraw = new Withdraw();
        $withdraw->insert($data);
        return $withdraw;
    }

    public function getlastwithdrawid(){
        return $this->orderBy('withdraw_request_id', 'desc')->first();
    }

    public function listwithdrawAccount($wallet_account_id){
        return $this->where('wallet_account_id',$wallet_account_id)->get();
    }
    public function listwithdrawAccount5($wallet_account_id){
        return $this->where('wallet_account_id',$wallet_account_id)->limit(5)->get();
    }
    public function listAllwithdraw(){
        return $this->get();
    }
    public function getwithdraw($withdraw_request_id){
        return $this->where('withdraw_request.withdraw_request_id',$withdraw_request_id)
        ->join('wallet','wallet.wallet_account_id','=','withdraw_request.wallet_account_id')
        ->join('trx_history','trx_history.withdraw_request_id','=','withdraw_request.withdraw_request_id')
        ->first();
    }

    public function updatewithdraw($withdraw_request_id,$data){
        return $this->where('withdraw_request_id',$withdraw_request_id)->update($data);
    }

    public function seach($keywd)
    {
        return $this->where('withdraw_request_id', 'like', '%' . $keywd . '%')
            ->orWhere('wallet_account_id', 'like', '%' . $keywd . '%')
            ->get();
    }
    public function getListped(){
        return $this->where('status',1)->get();
    }
    public function getRejected(){
        return $this->where('status',3)->get();
    }
    public function getaproved(){
        return $this->where('status',2)->get();
    }
}
