<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_name",
        "full_name",
        "phone",
        "email",
        "google_id",
        "password",
        "address",
        'user_image',
        "roles_id",
        'status',
        'verify',

    ];

    public function role()
    {
        return $this->belongsTo(RoleModel::class, 'roles_id');
    }


    public function orders()
    {
        return $this->hasMany(OrderModel::class, 'users_id');
    }

    public function comments()
    {
        return $this->hasMany(CommentModel::class, 'users_id');
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function role(){
    //     return $this->belongsTo(Role::class);
    // }
    public function listUser(){
        return $this->select('id','full_name','email','address','user_image')->get();
    }
    public function getUser($id){
        return $this->where('id',$id)->first();
    }

    public function searchUser($key){
        return $this->where('full_name','like','%'.$key.'%')
        ->orWhere('email','like','%'.$key.'%')
        ->orWhere('id','like','%'.$key.'%')
        ->get();

    }
}
