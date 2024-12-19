<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;
    protected $table = "otp";
    protected $fillable = ['otp_code', 'expired_at','user_id'];

    public function createCustomOTP($otp_code, $expired_at,$user_id)
    {
        $this->otp_code = $otp_code;
        $this->expired_at = $expired_at;
        $this->user_id = $user_id;
        $this->save();
        return $this;
    }

    public function deleteCode($otp_code)
    {
        $this->where('otp_code', $otp_code)->delete();
    }

    public function create_otpcode($user_id)
    {
        $otp_code = rand(10000, 99999);
        $this->otp_code = $otp_code;
        $this->expired_at = date('Ymdhis', strtotime('+5 minutes'));
        $this->user_id = $user_id;
        $this->save();
        return $otp_code;
    }
    public function verifyOTP($otp_code) {
        return $this->where('otp_code', $otp_code)->where('expired_at', '>', date('Ymdhis'))->first();
    }
    public function deleteUserOTP($user_id)
    {
        $this->where('user_id', $user_id)->delete();
    }
}
