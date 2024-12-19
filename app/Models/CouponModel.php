<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CouponModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'coupons';
    protected $fillable = [
        'name',
        'date_start',
        'date_end',
        'code',
        'description',
        'discount_amount',
        'discount_type',
        'quantity',
        'minimum_spend',
    ];

}
