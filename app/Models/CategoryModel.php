<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'note',
        'image_cover',
        'parent_id',
    ];

    public function products()
    {
        return $this->hasMany(ProductModel::class, 'category_id');
    }
}
