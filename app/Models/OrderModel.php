<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'orders';
    protected $fillable = [
        'users_id', 
        'user_name',
        'user_phone',
        'user_email',
        'user_address',
        'user_note',
        'ship_user_name',
        'ship_user_phone',
        'ship_user_email',
        'ship_user_address',
        'ship_user_note',
        'status_order',
        'payment_method',
        'total_price',
        'date_create_order',
        'code_coupon',
        'discount_type',
        'discount',
        'shipping_method',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetailModel::class, 'order_id');
    }
}
