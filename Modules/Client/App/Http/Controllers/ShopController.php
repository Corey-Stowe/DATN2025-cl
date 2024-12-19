<?php

namespace Modules\Client\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ColorAttribute;
use App\Models\Comment;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\SizeAttribute;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::query()->where(['is_active' => 1])->latest('id')->paginate(9);
        $tags = Tag::query()->get();
        $categories = Category::query()->get();
        $colors = ColorAttribute::query()->get();
        $sizes = SizeAttribute::query()->get();
        return view('client::contents.shops.shopIndex', compact('data', 'tags', 'categories', 'colors', 'sizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function rendAjax(Request $request)
    {
        $prdVariants = ProductVariant::query()->with(['color:id,color_value'])->where([
            'size_attribute_id' => $request->idSize,
            'product_id' => $request->prd_id
        ])->get();
        if (count($prdVariants) > 0) {
            return response()->json([
                'data' => $prdVariants->pluck('color')
            ]);
        } else {
            return response()->json([
                'error' => 'Không tìm thấy biến thể màu cho sản phẩm này!'
            ]);
        }
    }
    public function rendPrdV(Request $request)
    {
        $prdVariants = ProductVariant::query()->with(['color:id,color_value'])->where([
            'product_id' => $request->prd_id,
            'size_attribute_id' => $request->idSize,
            'color_attribute_id' => $request->idColor
        ])->first();
        if ($prdVariants) {
            $color = $prdVariants->color;
            $size = $prdVariants->size;
            return response()->json([
                'id' => $prdVariants->id,
                'product_id' => $prdVariants->product_id,
                'color_attribute_id' => $prdVariants->color_attribute_id,
                'size_attribute_id' => $prdVariants->size_attribute_id,
                'color_value' => $color->color_value,
                'size_value' => $size->size_value,
                'price_default' => $prdVariants->price_default,
                'price_sale' => $prdVariants->price_sale,
                'start_date' => $prdVariants->start_date,
                'end_date' => $prdVariants->end_date,
                'quantity' => $prdVariants->quantity,
            ]);
        } else {
            return response()->json([
                'error' => 'Không tìm thấy biến thể sản phẩm với màu và kích thước bạn đã chọn!'
            ]);
        }
    }

    /**
     * Show the specified resource.
     */
    // public function show(string $slug)
    // {

    //     $data = Product::query()->where(['slug' => $slug])->first();
    //     if ($data) {
    //         return view('client::contents.shops.productDetail', compact('data'));
    //     } else {
    //         return abort(404);
    //     }
    // }
    public function show(string $slug)
    {

        $data = Product::query()->where(['slug' => $slug])->first();
        $realedProducts = Product::query()->where(['sub_category_id' => $data->sub_category_id])->where('id', '!=', $data->id)->get();
        $qproduct = new Product();
        $dataq = $qproduct->GetToalQuantity($slug);
      //dd($dataq);
        if ($data) {
            // Lấy danh sách bình luận và thông tin người dùng liên quan
            $comments = Comment::with('user') // Eager load quan hệ 'user'
                ->where('products_id', $data->id)
                ->where('status', 2)
                ->orderBy('comment_date', 'desc')
                ->get();
            $averageRating = ceil($comments->avg('rating'));
            // dd($comments);
            $realedProducts = Product::query()->where(['sub_category_id' => $data->sub_category_id])->where('id', '!=', $data->id)->get();
            // dd($realedProducts);
            return view('client::contents.shops.productDetail', compact('data', 'realedProducts', 'comments', 'averageRating','dataq'));
        } else {
            return abort(404);
        }
    }

    public function filterproduct(Request $request)
    {
        //dd($request->all());
        // Khởi tạo query cơ bản
        $query = Product::query();
        //join table
        $query->join('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id');
        $query->join('categories', 'sub_categories.category_id', '=', 'categories.id');
        $query->join('product_variants', 'products.id', '=', 'product_variants.product_id');
        $query->join('color_attributes', 'product_variants.color_attribute_id', '=', 'color_attributes.id');
        $query->join('size_attributes', 'product_variants.size_attribute_id', '=', 'size_attributes.id');
        $query->groupBy('products.id', 'sub_categories.name', 'categories.name','products.sub_category_id','products.name','products.sku','products.slug','products.image_avatar','products.price_regular','products.price_sale','products.discount_percent','products.description','products.material','products.is_active','products.quantity','products.views','products.start_date','products.end_date','products.created_at','products.updated_at','products.deleted_at');
        //$query->groupBy('products.id');
        $query->select(
            'products.*',
            'sub_categories.name as sub_category_name',
            'categories.name as category_name',
            DB::raw('MIN(color_attributes.color_value) as color_value'),
            DB::raw('MIN(size_attributes.size_value) as size_value')
        );

        // Lọc theo giá
        if ($request->filled('min_price')) {
            $query->where('products.price_sale', '>=', $request->min_price);

        }

        if ($request->filled('max_price')) {
            $query->where('products.price_sale', '<=', $request->max_price);
            // echo ('filled max_price');
        }

        // Lọc theo danh mục
        if ($request->filled('categories')) {
            $categories = array_map('intval', $request->categories);
            $query->whereIn('category_id', $request->$categories);
        }
        if ($request->filled('sub_categories')) {
            $subCategories = array_map('intval', $request->sub_categories);
            $query->whereIn('sub_categories.id', $subCategories);
        }

        // Lọc theo màu sắc
        if ($request->filled('color')) {
            $color = array_map('intval', $request->color);
            $query->whereIn('color_attributes.id', $color);
        }

        // Lọc theo kích thước
        if ($request->filled('size')) {
            $size = array_map('intval', $request->size);
            $query->whereIn('size_attributes.id', $size);
        }

        // Sắp xếp theo yêu cầu
        if ($request->filled('short')) {
            switch ($request->short) {
                case 'price_asc':
                    $query->orderBy('products.price_regular', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('products.price_regular', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('products.name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('products.name', 'desc');
                    break;
                default:
                    $query->orderBy('products.created_at', 'desc');
            }
        }

        // Lấy dữ liệu sau khi lọc
        $data = $query->paginate(12)->appends($request->query());
        $data1 = $query->get();
        $tags = Tag::query()->get();
        $categories = Category::query()->get();
        $colors = ColorAttribute::query()->get();
        $sizes = SizeAttribute::query()->get();
       // dd($data1);
        return view('client::contents.shops.shopIndex', compact('data', 'tags', 'categories', 'colors', 'sizes'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function showproduct($kwd)
    {
        $product = new Product();
        $data =  $product->fullproductdetail($kwd);
        dd($data);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
}
