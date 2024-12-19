<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEkyc extends Model
{
    use HasFactory;
    protected $table = "user_wallet_detail";
    protected $fillable = [
        "user_id",
        "id_card_image_front",
        "id_card_image_back",
        "id_card_face",
        "id_number",
        "frist_name",
        "last_name",
        "date_of_birth",
        "nationality",
        "place_of_residence",
        "place_of_birth",
        "issue_date",
        "date_of_expiry",
        "place_of_issue",
        "gender",
        "status",
        "fillstep",
        "phone_number",
        ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function setfillekyc($user_id){
        return $this->where('user_id', $user_id)->update([
            'fillstep' => 'EKYC',
        ]);
    }
    public function setfilltos($user_id){
        return $this->where('user_id', $user_id)->update([
            'fillstep' => 'TOS',
        ]);
    }
    public function setfilladdress($user_id){
        return $this->where('user_id', $user_id)->update([
            'fillstep' => 'ADDRESS',
        ]);
    }
    public function setfillCompleted($user_id){
        return $this->where('user_id', $user_id)->update([
            'fillstep' => 'COMPLETED',
        ]);
    }
    public function setStatusPendingFilled($user_id){
        return $this->where('user_id', $user_id)->update([
            'status' => 'PENDING_FILLED',
        ]);
    }
    public function setStasusCompleted($user_id){
        return $this->where('user_id', $user_id)->update([
            'status' => 'COMPLETED',
            ]);
        }
    public function setStasusCompletedBasic($user_id){
        return $this->where('user_id', $user_id)->update([
            'status' => 'COMPLETED_BASIC',
            ]);
        }
    public function setStasusAprroved($user_id){
        return $this->where('user_id', $user_id)->update([
            'status' => 'APROVED',
            ]);
        }

        public function setStasusPedingAprroved($user_id){
            return $this->where('user_id', $user_id)->update([
                'status' => 'PENDING_APROVED',
                ]);
            }
    public function setStasusRejected($user_id){
        return $this->where('user_id', $user_id)->update([
            'status'=> 'REJECTED',
            ]);
        }
    public function getUserKycInfo($user_id){
        return $this->where('user_id', $user_id)->first();
    }
    public function adduserinfo($data){
        return $this->create($data);
    }
    public function updateuserinfo($user_id,$data){
        return $this->where('user_id', $user_id)->update($data);
    }

    public function listPedingUser(){
        return $this->join("wallet","wallet.user_id","=","user_wallet_detail.user_id")
        ->where('user_wallet_detail.status', "PENDING_APROVED")
        ->get();
    }
    public function getUserKyc($id){
        return $this
        ->join("wallet","wallet.user_id","=","user_wallet_detail.user_id")
        ->where('user_wallet_detail.user_id', $id)->first();
    }

}
