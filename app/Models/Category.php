<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    public $table = 'categories';
    protected $fillable = [
        'name',
        'slug',
        'note',
        'image_cover',
    ];

    public $timestamp = false;
    protected $dates = ['deleted_at'];
    public function sub_category()
    {
        return $this->hasMany(SubCategory::class);
    }
    public function listcategory10()
    {
        return $this->query()->latest('id')->limit(10)->get();
    }
}
