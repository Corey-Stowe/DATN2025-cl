<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';
    protected $fillable = [
        'sub_category_id',
        'name',
        'sku',
        'slug',
        'image_avatar',
        'price_regular',
        'price_sale',
        'discount_percent',
        'description',
        'material',
        'views',
        'quantity',
        'start_date',
        'end_date',
        'is_active',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function sub_category()
    {
        // 1-1
        return $this->belongsTo(SubCategory::class);
    }
    public function images()
    {
        // 1-n
        return $this->hasMany(ProductImage::class);
    }
    public function tags()
    {
        // n-n
        return $this->belongsToMany(Tag::class);
    }
    public function product_variants()
    {
        // 1-n
        return $this->hasMany(ProductVariant::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }

    public function searchproduct($keywd)
    {
        return $this
            ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
            ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
            ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->join('color_attributes', 'product_variants.color_attribute_id', '=', 'color_attributes.id')
            ->join('size_attributes', 'product_variants.size_attribute_id', '=', 'size_attributes.id')
            ->where(function ($query) use ($keywd) {
                $query->where('products.name', 'like', '%' . $keywd . '%')
                    ->orWhere('sku', 'like', '%' . $keywd . '%')
                    ->orWhere('categories.name', 'like', '%' . $keywd . '%');
            })
            ->select('products.*') // Các cột cần thiết
            ->whereNotIn('is_active', [0])
           // ->appends(['keywd' => $keywd])
            ->distinct(); // Loại bỏ các dòng trùng lặp;
    }

    function searchproductbyprice($min,$max){
        return $this
        ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
        ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
        ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
        ->join('color_attributes', 'product_variants.color_attribute_id', '=', 'color_attributes.id')
        ->join('size_attributes', 'product_variants.size_attribute_id', '=', 'size_attributes.id')
        ->whereBetween('products.price_regular',[$min,$max])
        ->select('products.*')
        ->distinct()
        ->whereNotIn('is_active', [0])
        ->paginate(12);
    }
    function searchproductbycategory($id,$keywd){
        return $this
        ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
       ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
       ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
       ->join('color_attributes', 'product_variants.color_attribute_id', '=', 'color_attributes.id')
       ->join('size_attributes', 'product_variants.size_attribute_id', '=', 'size_attributes.id')

        ->where('categories.id',$id)
        ->where(function ($query) use ($keywd) {
            $query->where('products.name', 'like', '%' . $keywd . '%')
                  ->orWhere('products.sku', 'like', '%' . $keywd . '%')
                  ->orWhere('categories.name', 'like', '%' . $keywd . '%');
        })
        ->select('products.*')
        ->distinct()
        ->whereNotIn('is_active', [0])
        ->paginate(12);
    }
    function searchproductbytag($id){
        return $this
        ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
        ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
        ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
        ->join('color_attributes', 'product_variants.color_attribute_id', '=', 'color_attributes.id')
        ->join('size_attributes', 'product_variants.size_attribute_id', '=', 'size_attributes.id')

        ->where('tags.id',$id)
        ->select('products.*')
        ->distinct()
        ->whereNotIn('is_active', [0])
        ->paginate(12);
    }
    function searchproductbypriceandcategory($min,$max,$id){
        return $this
        ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
        ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
        ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
        ->join('color_attributes', 'product_variants.color_attribute_id', '=', 'color_attributes.id')
        ->join('size_attributes', 'product_variants.size_attribute_id', '=', 'size_attributes.id')

        ->whereBetween('products.price_regular',[$min,$max])
        ->where('categories.id',$id)
        ->select('products.*')
        ->distinct()
        ->whereNotIn('is_active', [0])
        ->paginate(12);
    }
    function searchproductbypriceandtag($min,$max,$id){
        return $this
        ->join('product_tag','products.id','=','product_tag.product_id')
        ->join('tags','product_tag.tag_id','=','tags.id')

        ->whereBetween('products.price_regular',[$min,$max])
        ->where('tags.id',$id)
        ->select('products.*')
        ->distinct()
        ->whereNotIn('is_active', [0])
        ->paginate(12);
    }
    function seachproductatoz($keywd){
        return $this
        ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
        ->join('categories as parent_categories', 'sub_categories.category_id', '=', 'parent_categories.id')
        ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
        ->join('color_attributes', 'product_variants.color_attribute_id', '=', 'color_attributes.id')
        ->join('size_attributes', 'product_variants.size_attribute_id', '=', 'size_attributes.id')

        ->where(function ($query) use ($keywd) {
            $query->where('products.name', 'like', '%' . $keywd . '%')
                  ->orWhere('products.sku', 'like', '%' . $keywd . '%')
                  ->orWhere('parent_categories.name', 'like', '%' . $keywd . '%');
        })
        ->select('products.*')
        ->orderBy('products.name','asc')
        ->distinct()
        ->whereNotIn('is_active', [0])
        ->paginate(12);
    }
    function seachproductztoa($keywd){
        return $this
        ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
        ->join('categories as parent_categories', 'sub_categories.category_id', '=', 'parent_categories.id')
        ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
        ->join('color_attributes', 'product_variants.color_attribute_id', '=', 'color_attributes.id')
        ->join('size_attributes', 'product_variants.size_attribute_id', '=', 'size_attributes.id')
        ->where(function ($query) use ($keywd) {
            $query->where('products.name', 'like', '%' . $keywd . '%')
                  ->orWhere('products.sku', 'like', '%' . $keywd . '%')
                  ->orWhere('parent_categories.name', 'like', '%' . $keywd . '%');
        })
        ->select('products.*')
        ->orderBy('products.name','desc')
        ->distinct()
        ->whereNotIn('is_active', [0])
        ->paginate(12);
    }
    function seachproductrateprice($keywd){
        return $this
        ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
        ->join('categories as parent_categories', 'sub_categories.category_id', '=', 'parent_categories.id')
        ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
        ->join('color_attributes', 'product_variants.color_attribute_id', '=', 'color_attributes.id')
        ->join('size_attributes', 'product_variants.size_attribute_id', '=', 'size_attributes.id')
        ->where(function ($query) use ($keywd) {
            $query->where('products.name', 'like', '%' . $keywd . '%')
                  ->orWhere('products.sku', 'like', '%' . $keywd . '%')
                  ->orWhere('categories.name', 'like', '%' . $keywd . '%');
        })
        ->select('products.*')
        ->orderBy('products.price_regular','asc')
        ->distinct()
        ->whereNotIn('is_active', [0])
        ->paginate(12);
    }

    function searchhint($keywd){
        return $this
        ->where('name','like','%'.$keywd.'%')
        ->orWhere('material','like','%'.$keywd.'%')
        ->orWhere('description','like','%'.$keywd.'%')
        ->select('name')
        ->limit(5)
        ->distinct()
        ->whereNotIn('is_active', [0])
        ->paginate(12);
    }
    function seachproductpricelowtohigh($keywd){
        return $this
            ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
            ->join('categories as parent_categories', 'sub_categories.category_id', '=', 'parent_categories.id')
            ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->join('color_attributes', 'product_variants.color_attribute_id', '=', 'color_attributes.id')
            ->join('size_attributes', 'product_variants.size_attribute_id', '=', 'size_attributes.id')
            ->where(function ($query) use ($keywd) {
                $query->where('products.name', 'like', '%' . $keywd . '%')
                      ->orWhere('products.sku', 'like', '%' . $keywd . '%')
                      ->orWhere('parent_categories.name', 'like', '%' . $keywd . '%');
            })
            ->select('products.*')
            ->orderBy('products.price_sale', 'asc')
            ->distinct()
            ->whereNotIn('is_active', [0])
            ->paginate(12);
    }
    function seachproductpricehightolow($keywd){
        return $this
            ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
            ->join('categories as parent_categories', 'sub_categories.category_id', '=', 'parent_categories.id')
            ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->join('color_attributes', 'product_variants.color_attribute_id', '=', 'color_attributes.id')
            ->join('size_attributes', 'product_variants.size_attribute_id', '=', 'size_attributes.id')
            ->where(function ($query) use ($keywd) {
                $query->where('products.name', 'like', '%' . $keywd . '%')
                      ->orWhere('products.sku', 'like', '%' . $keywd . '%')
                      ->orWhere('parent_categories.name', 'like', '%' . $keywd . '%');
            })
            ->select('products.*')
            ->orderBy('products.price_sale', 'desc')
            ->distinct()
            ->whereNotIn('is_active', [0])
            ->paginate(12);
    }
    function searchproductprice($keywd, $min, $max) {
        return $this
            ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
            ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
            ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->join('color_attributes', 'product_variants.color_attribute_id', '=', 'color_attributes.id')
            ->join('size_attributes', 'product_variants.size_attribute_id', '=', 'size_attributes.id')
            ->where(function ($query) use ($keywd) {
                $query->where('products.name', 'like', '%' . $keywd . '%')
                      ->orWhere('products.sku', 'like', '%' . $keywd . '%')
                      ->orWhere('categories.name', 'like', '%' . $keywd . '%');
            })
            ->where(function ($query) use ($min, $max) {
                $query->whereBetween('products.price_sale', [$min, $max])
                      ->orWhereBetween('products.price_regular', [$min, $max]);
            })
            ->select('products.*')
            ->distinct()
            ->whereNotIn('is_active', [0])
            ->paginate(12);
    }
    public function fullproductdetail($keywd){
        return $this
       ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
       ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
       ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
       ->join('color_attributes', 'product_variants.color_attribute_id', '=', 'color_attributes.id')
       ->join('size_attributes', 'product_variants.size_attribute_id', '=', 'size_attributes.id')
       ->where(function ($query) use ($keywd) {
        $query->where('products.name', 'like', '%' . $keywd . '%')
              ->orWhere('products.sku', 'like', '%' . $keywd . '%')
              ->orWhere('categories.name', 'like', '%' . $keywd . '%')
              ->orWhere('products.id', 'like', '%' . $keywd . '%')
              ->orWhere('sub_categories.name', 'like', '%' . $keywd . '%');
        })
       ->get();
    }

    public function GetToalQuantity($slug){
        return $this
        ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
        ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
        ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
        ->whereNull('product_variants.deleted_at')
        ->select(
        DB::raw('SUM(product_variants.quantity) as total_variants_products')
    )
    ->where('products.slug', $slug)
    ->groupBy(
        'products.id',
        'products.sub_category_id',
        'products.name',
        'products.sku',
        'products.slug',
        'products.image_avatar',
        'products.price_regular',
        'products.price_sale',
        'products.discount_percent',
        'products.description',
        'products.material',
        'products.views',
        'products.quantity',
        'products.start_date',
        'products.end_date',
        'products.is_active',
        'sub_categories.name',
        'products.created_at',
        'products.updated_at',
        'products.deleted_at',
        'categories.name'
    )
    ->get('total_variants_products');
    }
    public function GetToalQuantityinf(){
        return $this
        ->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
        ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
        ->join('product_variants', 'products.id', '=', 'product_variants.product_id')
        ->whereNull('product_variants.deleted_at')
        ->select(
        DB::raw('SUM(product_variants.quantity) as total_variants_products'), 'products.*'
    )
    ->groupBy(
        'products.id',
        'products.sub_category_id',
        'products.name',
        'products.sku',
        'products.slug',
        'products.image_avatar',
        'products.price_regular',
        'products.price_sale',
        'products.discount_percent',
        'products.description',
        'products.material',
        'products.views',
        'products.quantity',
        'products.start_date',
        'products.end_date',
        'products.is_active',
        'sub_categories.name',
        'products.created_at',
        'products.updated_at',
        'products.deleted_at',
        'categories.name'
    )
    ->paginate(10);
    }
}
