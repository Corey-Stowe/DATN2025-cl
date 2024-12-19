<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'product_id',
        'size_attribute_id',
        'color_attribute_id',
        'price_default',
        'price_sale',
        'start_date',
        'end_date',
        'quantity',
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function size(){
        return $this->belongsTo(SizeAttribute::class, 'size_attribute_id', 'id');
    }
    public function color(){
        return $this->belongsTo(ColorAttribute::class, 'color_attribute_id', 'id');
    }
}
