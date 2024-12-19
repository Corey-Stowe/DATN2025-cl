<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetailModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'order_details';

    protected $fillable = [
        'order_id',
        'product_id', 
        'product_name',
        'product_sku',
        'product_avatar',
        'product_price_final',
        'product_quantity',
    ];

    public function order()
    {
        return $this->belongsTo(OrderModel::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id'); 
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetailModel::class, 'order_id', 'id');
    }
}
