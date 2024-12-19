<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trx_history extends Model
{
    use HasFactory;
     protected $table = "trx_history";
     protected $fillable = [
        "trx_id",
        "wallet_account_id",
        "trx_type",
        "trx_from",
        "trx_to",
        "trx_amount",
        "trx_balance_available",
        "trx_hash_request",
        "withdraw_request_id",
        "trx_status"
    ];



    public function get20trx($wallet_account_id){
        return $this->where('wallet_account_id', $wallet_account_id)->orderBy('created_at', 'desc')->take(20)->get();
    }
    public function gettrxuser($wallet_account_id){
        return $this->where('trx_history.wallet_account_id', $wallet_account_id)
        ->join('trx_history_detail','trx_history_detail.trx_id','=','trx_history.trx_id')
        ->orderBy('trx_history_detail.trx_id', 'desc')
        ->paginate(5);
    }
    public function trans_detail_withdraw($trx_id){
        return $this->where('trx_history.trx_id', $trx_id)
        ->join('trx_history_detail','trx_history_detail.trx_id','=','trx_history.trx_id')
        ->join('withdraw_request','withdraw_request.withdraw_request_id','=','trx_history.withdraw_request_id')
        ->get();
    }
    public function trans_detail($trx_id){
        return $this->where('trx_history.trx_id', $trx_id)
        ->join('trx_history_detail','trx_history_detail.trx_id','=','trx_history.trx_id')
        ->get();
    }

    public function checkHash($hash){
        return $this->where('trx_hash_request', $hash)->exists();
    }

    public function createTrx($data ){
        $trx = new Trx_history();
        $trx->insert($data);
        return $trx;
    }
    public function getLasttrxid(){
        return $this->orderBy('trx_id', 'desc')->first();
    }
    public function updateTrx($trx_id, $data){
        $trx = new Trx_history();
        $trx->where('trx_id', $trx_id)
        ->update($data);
        return $trx;
    }
    public function searchdatetodate($from, $to){
        return $this->whereBetween('created_at', [$from, $to])->get();
    }

}
