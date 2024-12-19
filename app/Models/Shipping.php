<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $table = "user_shipping";
    protected $fillable = ['order_id', 'status', 'latitude', 'longitude'];

    public $timestamps = false;



    public function Order()
    {
        return $this->belongsTo(Order::class);
    }

    public function createShipping($order_id){
        return $this->create([
            'order_id'=> $order_id,
            'status' => 'Đơn hàng đang được chuẩn bị',
            'latitude' => "10.8231",
            'longitude'=> "106.6297",
            'updated_at' => now()
            ]);
    }
     public function updateShipping($data, $order_id){
               return $this->where('order_id', $order_id)->insert($data);
    }

    public function getLastUpdateShipping($order_id){
        return $this->where('order_id', $order_id)->orderBy('updated_at', 'desc')->first();
    }
    public function getShipping($order_id){
        return $this->where('order_id', $order_id)->orderBy('updated_at', 'desc')->get();
    }
    public function getOldestShipping($order_id){
        return $this->where('order_id', $order_id)->orderBy('updated_at', 'asc')->first();
    }
}
