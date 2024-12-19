<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webautn extends Model
{
    use HasFactory;
    protected $table = "webauthn_keys";
    protected $fillable = [
        "user_id",
        "name",
        "credentialId",
        "type",
        "transports",
        "attestationType",
        "trustPath",
        "aaguid",
        "credentialPublicKey",
        "counter"
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function CreateAuthKey($data){
        return $this->create($data);
    }

    public function getUserKey($user_id){
        return $this->where('user_id', $user_id)->get();
    }

    public function deletekey($user_id){
        return $this->where('user_id', $user_id)->delete();
    }
    public function updateKey($user_id, $data){
        return $this->where('user_id', $user_id)->update($data);
    }
}
