<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trx_history_detail extends Model
{
    use HasFactory;
    protected $table = "trx_history_detail";
    protected $fillable = [
        "trx_detail_desc",
        "trx_date_issue",
        "vnp_BankTranNo",
        "vnp_SecureHash",
        "vnp_ResponseCode",
        "vnp_TxnRef",
        "vnp_TransactionNo",
        "vnp_PayDate",
        "vnp_CardType",
        "BankCode",
        "charge_id"
    ];


    public function createTrxDetail($data){
        $trx = new Trx_history_detail();
        $trx->insert($data);
        return $trx;
    }
}
