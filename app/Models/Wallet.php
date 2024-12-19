<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Wallet extends Model
{
    use HasFactory;
    protected $table = 'wallet';
    protected $fillable = [
        'user_id',
        'wallet_account_id',
        'wallet_balance_available',
        'wallet_status',
        'wallet_user_level',
        'wallet_trust_device_id',
        'admin_note'
    ];
    protected $primaryKey = 'wallet_account_id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checkWalletVaild($user_id)
    {
        return $this->where('user_id', $user_id)->exists();
    }

    public function listAllWallet(){
        return $this->join('user_wallet_detail' ,'user_wallet_detail.user_id','=','wallet.user_id')
        ->get();
    }
    public function getWalletInfo($wallet_account_id){
        return $this->join('user_wallet_detail' ,'user_wallet_detail.user_id','=','wallet.user_id')
        ->where('wallet_account_id', $wallet_account_id)
        ->first();
    }

    public function createWallet($data)
    {
        $wallet = new Wallet();
        $wallet->insert($data);
        return $wallet;
    }

    public function getWallet($user_id)
    {
        return $this
        ->join('user_wallet_detail' ,'user_wallet_detail.user_id','=','wallet.user_id')
        ->where('wallet.user_id', $user_id)->first();
    }
    public function getwalleuid($user_id)
    {
        return $this
        ->select('wallet_account_id')
        ->where('user_id', $user_id)->first();
    }

    public function addBalance($wallet_account_id, $amount)
    {
        return DB::transaction(function () use ($wallet_account_id, $amount) {
            $wallet = $this->where('wallet_account_id', $wallet_account_id)->lockForUpdate()->first();
            if (!$wallet) {
                throw new \Exception("Wallet not found");
            }
            $wallet->wallet_balance_available += $amount;
            $wallet->save();
            return $wallet;
        });
    }

    public function setBalance($wallet_account_id, $amount)
    {
        return DB::transaction(function () use ($wallet_account_id, $amount) {
            $wallet = $this->where('wallet_account_id', $wallet_account_id)->lockForUpdate()->first();
            if (!$wallet) {
                throw new \Exception("Wallet not found");
            }
            $wallet->wallet_balance_available = $amount;
            $wallet->save();
            return $wallet;
        });
    }

    public function takeBalance($wallet_account_id, $amount)
    {
        return DB::transaction(function () use ($wallet_account_id, $amount) {
            $wallet = $this->where('wallet_account_id', $wallet_account_id)->lockForUpdate()->first();
            if (!$wallet) {
                throw new \Exception("Wallet not found");
            }
            $wallet->wallet_balance_available -= $amount;
            $wallet->save();
            return $wallet;
        });
    }

    public function setActiveWallet($wallet_account_id)
    {
        return DB::transaction(function () use ($wallet_account_id) {
            $wallet = $this->where('wallet_account_id', $wallet_account_id)->lockForUpdate()->first();
            if (!$wallet) {
                throw new \Exception("Wallet not found");
            }
            $wallet->wallet_status = 1;
            $wallet->save();
            return $wallet;
        });
    }

    public function setInActiveWallet($wallet_account_id)
    {
        return DB::transaction(function () use ($wallet_account_id) {
            $wallet = $this->where('wallet_account_id', $wallet_account_id)->lockForUpdate()->first();
            if (!$wallet) {
                throw new \Exception("Wallet not found");
            }
            $wallet->wallet_status = 2;
            $wallet->save();
            return $wallet;
        });
    }

    public function setLockedWallet($wallet_account_id)
    {
        return DB::transaction(function () use ($wallet_account_id) {
            $wallet = $this->where('wallet_account_id', $wallet_account_id)->lockForUpdate()->first();
            if (!$wallet) {
                throw new \Exception("Wallet not found");
            }
            $wallet->wallet_status = 3;
            $wallet->save();
            return $wallet;
        });
    }

    public function setLevelBasicWallet($wallet_account_id)
    {
        return DB::transaction(function () use ($wallet_account_id) {
            $wallet = $this->where('wallet_account_id', $wallet_account_id)->lockForUpdate()->first();
            if (!$wallet) {
                throw new \Exception("Wallet not found");
            }
            $wallet->wallet_user_level = 1;
            $wallet->save();
            return $wallet;
        });
    }

    public function setLevelFullWallet($wallet_account_id)
    {
        return DB::transaction(function () use ($wallet_account_id) {
            $wallet = $this->where('wallet_account_id', $wallet_account_id)->lockForUpdate()->first();
            if (!$wallet) {
                throw new \Exception("Wallet not found");
            }
            $wallet->wallet_user_level = 2;
            $wallet->save();
            return $wallet;
        });
    }

    public function getWalletStastus($wallet_account_id){
        return $this
        ->select('wallet_status')
        ->where('wallet_account_id', $wallet_account_id)->first();
    }
    public function getWalletLevel($wallet_account_id){
        return $this
        ->select('wallet_user_level')
        ->where('wallet_account_id', $wallet_account_id)->first();
    }
    public function updateAdminNote($wallet_account_id, $note ){
        return DB::transaction(function () use ($wallet_account_id, $note){
            $wallet = $this->where('wallet_account_id', $wallet_account_id)->lockForUpdate()->first();
            $wallet->admin_note = $note;
            $wallet->save();
            return $wallet;
        });
    }
    public function search($keywd){
        return $this
        ->join('user_wallet_detail' ,'user_wallet_detail.user_id','=','wallet.user_id')
        ->where('wallet.wallet_account_id', 'like', '%' . $keywd . '%')
        ->orWhere('wallet.user_id', 'like', '%' . $keywd . '%')
        ->get();
    }
}

