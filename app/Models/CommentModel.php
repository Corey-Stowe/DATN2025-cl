<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommentModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'products_id',
        'users_id',
        'comments',
        'rating',
        'comment_date',
    ];

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'products_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');  

    }
}
