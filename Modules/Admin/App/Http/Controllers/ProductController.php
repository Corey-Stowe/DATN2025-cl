<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductUpdate;
use App\Http\Requests\ProductValidation;
use App\Models\Category;
use App\Models\ColorAttribute;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\SizeAttribute;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function listProduct()
    {
        $product = new Product();
        $data = $product->GetToalQuantityinf();
        return view('admin::contents.products.listProduct', compact('data'));
    }
    public function trashed()
    {
        $data = Product::onlyTrashed()->with(['tags'])->latest('id')->paginate(10);
        return view('admin::contents.products.product_trashed', compact('data'));
    }
    public function restoreAll()
    {
        $data = Product::onlyTrashed()->restore();
        return redirect()->route('admin.product.list')->with(['success' => 'Khôi phục tất cả sản phẩm đã xóa thành công!']);
    }
    public function restoreOne(string $id)
    {
        $product = Product::withTrashed()->find($id);
        if ($product && $product->trashed()) {
            $product->restore();
            return redirect()->back()->with('success', 'Sản phẩm đã được khôi phục thành công.');
        }
        return redirect()->back()->with('error', 'Sản phẩm không tồn tại hoặc không bị xóa.');
    }
    public function showFormEdit(string $slug)
    {
        $product = new Product();
        $quantityPRD = $product->GetToalQuantity($slug);
        $data = Product::query()->with(['tags', 'images', 'sub_category'])->where('slug', $slug)->first();
        $variantPRD = ProductVariant::query()->where('product_id', $data->id)->get();
        $warningDate = '';
        if ($data->end_date) {
            $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i');
            $nowDate = Carbon::parse($now);
            $endDate = Carbon::parse($data->end_date);
            if ($nowDate->gt($endDate)) {
                $warningDate = 'Thời gian khuyến mại sản phẩm kết thúc';
            }
        }
        $categories = SubCategory::query()->get();
        $tags = Tag::query()->get();
        $colorAttr = ColorAttribute::query()->get();
        $sizeAttr = SizeAttribute::query()->get();
        return view(
            'admin::contents.products.edit',
            compact(
                'data',
                'categories',
                'tags',
                'colorAttr',
                'sizeAttr',
                'warningDate',
                'variantPRD',
                'quantityPRD',
            )
        );
    }
    public function showFormAdd()
    {
        $categories = SubCategory::query()->get();
        $tags = Tag::query()->get();
        $colorAttr = ColorAttribute::query()->get();
        $sizeAttr = SizeAttribute::query()->get();
        return view('admin::contents.products.showForm', compact('categories', 'tags', 'colorAttr', 'sizeAttr'));
    }
    public function createProduct(ProductValidation $request)
    {
        $dataProduct = [];
        $prd_img_temp = [];
        $dataProduct['prd_name'] = $request->prd_name;
        $dataProduct['prd_sku'] = $this->generateSKU();
        $dataProduct['prd_slug'] = $request->prd_slug;
        $dataProduct['price_regular'] = $request->price_regular;
        $dataProduct['price_sale'] = $request->price_sale;
        $dataProduct['discount_percent'] = $request->discount_percent;
        $dataProduct['prd_description'] = $request->prd_description ??= '<strong class="text-warning">Hiện chưa cập nhật mô tả cụ thể cho sản phẩm!</strong>';
        $dataProduct['prd_material'] = $request->prd_material ??= '<strong class="text-warning">Hiện chưa cập nhật chất liệu cho sản phẩm!</strong>';
        $dataProduct['prd_quantity'] = $request->prd_quantity ??= 0;
        $dataProduct['start_date'] = $request->start_date;
        $dataProduct['end_date'] = $request->end_date;
        $dataProduct['is_active'] = $request->is_active ??= 0;
        $productV = $request->prdV;
        if ($productV) {
            foreach ($productV as $idC => $value) {
                foreach ($value as $idS => $item) {
                    $startDate = $item["'start_date'"] ??= null;
                    $endDate = $item["'end_date'"] ??= null;
                    if ($startDate && $endDate) {
                        $startDate = Carbon::parse($startDate);
                        $endDate = Carbon::parse($endDate);
                        if ($startDate->gt($endDate)) {
                            return redirect()->back()->with(['prdVariant' => 'Ngày bắt đầu không được lớn hơn ngày kết thúc.'])->withInput();
                        }
                    }
                    $priceD = $item["'price_default'"] ??= null;
                    $priceS = $item["'price_sale'"] ??= null;
                    if ($priceD && $priceS && $priceS > $priceD) {
                        return redirect()->back()->with(['prdVariant' => 'Giá khuyến mại không được lớn hơn giá gốc.'])->withInput();
                    }
                }
            }
        } else {
            return redirect()->back()->with(['prdVariant' => 'Vui lòng xét thuộc tính cho sản phẩm!'])->withInput();
        }
        try {
            DB::beginTransaction();
            if ($request->hasFile('prd_avatar')) {
                $slugCategory = optional(Category::query()->find($request->prd_category))->slug ?? 'khong-phan-loai';
                Storage::put("public/products/image_avatar/$slugCategory", $request->file('prd_avatar'));
                $dataProduct['prd_avatar'] = "products/image_avatar/$slugCategory/" . $request->file('prd_avatar')->hashName();
            }
            $product = Product::query()->create(
                [
                    'sub_category_id' => $request->prd_category,
                    'name' => $dataProduct['prd_name'],
                    'sku' => $dataProduct['prd_sku'],
                    'slug' => $dataProduct['prd_slug'],
                    'image_avatar' => $dataProduct['prd_avatar'],
                    'price_regular' => $dataProduct['price_regular'],
                    'price_sale' => $dataProduct['price_sale'],
                    'discount_percent' => $dataProduct['discount_percent'],
                    'description' => $dataProduct['prd_description'],
                    'material' => $dataProduct['prd_material'],
                    'quantity' => $dataProduct['prd_quantity'],
                    'start_date' => $dataProduct['start_date'],
                    'end_date' => $dataProduct['end_date'],
                    'is_active' => $dataProduct['is_active'],
                ]
            );
            if ($request->hasFile('prd_images')) {
                $slugCategory = optional(Category::query()->find($request->prd_category))->slug ?? "khong-phan-loai";
                foreach ($request->file('prd_images') as $key => $image) {
                    Storage::put("public/products/image_galleries/$slugCategory", $image);
                    ProductImage::query()->create(
                        [
                            'product_id' => $product->id,
                            'image_path' => $prd_img = "products/image_galleries/$slugCategory/" . $image->hashName(),
                        ]
                    );
                    $prd_img_temp[$key] = $prd_img;
                }
            }
            if ($request->prd_tags && count($request->prd_tags) > 0) {
                $product->tags()->sync($request->prd_tags);
            }
            foreach ($productV as $idColor => $v) {
                foreach ($v as $idSize => $itemV) {
                    $prdVariant = $product->product_variants()->create(
                        [
                            'size_attribute_id' => $idSize,
                            'color_attribute_id' => $idColor,
                            'price_default' => $itemV["'price_default'"],
                            'price_sale' => $itemV["'price_sale'"],
                            'start_date' => $itemV["'start_date'"],
                            'end_date' => $itemV["'end_date'"],
                            'quantity' => $itemV["'quantity'"],
                        ]
                    );
                }
            }
            DB::commit();
            return redirect()->back()->with(['success' => 'Thêm mới sản phẩm thành công!']);
        } catch (\Exception $e) {
            if (isset($dataProduct['prd_avatar']) && $dataProduct['prd_avatar'] != null) {
                Storage::delete($dataProduct['prd_avatar']);
            }
            if (isset($prd_img_temp) && count($prd_img_temp) > 0) {
                foreach ($prd_img_temp as $img) {
                    Storage::delete($img);
                }
            }
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    public function updatePrd(ProductUpdate $request, Product $product)
    {
        // dd($request->prd_category);
        $data = Product::query()->findOrFail($product->id);
        $dataProduct = [];
        $prd_img_temp = [];
        $dataProduct['prd_category'] = $request->prd_category;
        $dataProduct['prd_name'] = $request->prd_name;
        $dataProduct['prd_slug'] = $request->prd_slug;
        if ($request->prd_slug == $data->slug) {
            $dataProduct['prd_slug'] = $data->slug;
        } else {
            $exits = Product::query()->where('slug', $request->prd_slug)->exists();
            if ($exits) {
                return redirect()->back()->with(['error' => 'Slug sản phẩm đã tồn tại trong hệ thống!'])->withInput();
            }
        }
        $dataProduct['price_regular'] = $request->price_regular;
        $dataProduct['price_sale'] = $request->price_sale;
        $dataProduct['discount_percent'] = $request->discount_percent;
        $dataProduct['prd_description'] = $request->prd_description ??= '<strong class="text-warning">Hiện chưa cập nhật mô tả cụ thể cho sản phẩm!</strong>';
        $dataProduct['prd_material'] = $request->prd_material ??= '<strong class="text-warning">Hiện chưa cập nhật chất liệu cho sản phẩm!</strong>';
        $dataProduct['prd_quantity'] = $request->prd_quantity ??= 0;
        $dataProduct['start_date'] = $request->start_date;
        $dataProduct['end_date'] = $request->end_date;
        $dataProduct['is_active'] = $request->is_active ??= 0;

        if ($request->prd_tags != null) {
            $dataTags = $request->prd_tags;
            foreach ($dataTags as $index => $value) {
                $exits = DB::table('product_tag')->where(
                    ['product_id' => $data->id, 'tag_id' => $value]
                )->exists();
                if ($exits) {
                    return redirect()->back()->with(['error' => "Sản phẩm đã được gắn thẻ tag với id $value!"]);
                }
            }
        }

        $productV = $request->prdV;
        if ($productV) {
            foreach ($productV as $idC => $value) {
                foreach ($value as $idS => $item) {
                    $startDate = $item["'start_date'"] ??= null;
                    $endDate = $item["'end_date'"] ??= null;
                    if ($startDate && $endDate) {
                        $startDate = Carbon::parse($startDate);
                        $endDate = Carbon::parse($endDate);
                        if ($startDate->gt($endDate)) {
                            return redirect()->back()->with(['prdVariant' => 'Ngày bắt đầu không được lớn hơn ngày kết thúc.'])->withInput();
                        }
                    }
                    $priceD = $item["'price_default'"] ??= null;
                    $priceS = $item["'price_sale'"] ??= null;
                    if ($priceD && $priceS && $priceS > $priceD) {
                        return redirect()->back()->with(['prdVariant' => 'Giá khuyến mại không được lớn hơn giá gốc.'])->withInput();
                    }
                }
            }
        }
        $updateVariants = $request->updateV;
        if ($updateVariants) {
            foreach ($updateVariants as $itemV) {
                $startDate = $itemV["'start_date'"] ??= null;
                $endDate = $itemV["'end_date'"] ??= null;
                if ($startDate && $endDate) {
                    $startDate = Carbon::parse($startDate);
                    $endDate = Carbon::parse($endDate);
                    if ($startDate->gt($endDate)) {
                        return redirect()->back()->with(['error' => 'Ngày bắt đầu không được lớn hơn ngày kết thúc.']);
                    }
                }
                $priceD = $itemV["'price_default'"] ??= null;
                $priceS = $itemV["'price_sale'"] ??= null;
                if ($priceD && $priceS && $priceS > $priceD) {
                    return redirect()->back()->with(['error' => 'Giá khuyến mại không được lớn hơn giá gốc.'])->withInput();
                }
            }
        }
        try {
            DB::beginTransaction();
            $tmpImgThumb = $data->image_avatar;
            $ctgr = Category::query()->where('id', $dataProduct['prd_category'])->first();
            if ($request->hasFile('prd_avatar')) {
                $slugCategory = optional(Category::query()->find($request->prd_category))->slug ?? 'khong-phan-loai';

                $viewpath = "products/image_avatar/$slugCategory/" . $request->file('prd_avatar')->hashName();

                $dataProduct['prd_avatar'] = Storage::put("public/products/image_avatar/$slugCategory", $request->file('prd_avatar'));
            } else {
                $viewpath = $data->image_avatar;
            }
            //dd($dataProduct['prd_category']);
            $data->update(
                [
                    'sub_category_id' => $dataProduct['prd_category'],
                    'name' => $dataProduct['prd_name'],
                    'slug' => $dataProduct['prd_slug'],
                    'image_avatar' => $viewpath,
                    'price_regular' => $dataProduct['price_regular'],
                    'price_sale' => $dataProduct['price_sale'],
                    'discount_percent' => $dataProduct['discount_percent'],
                    'description' => $dataProduct['prd_description'],
                    'material' => $dataProduct['prd_material'],
                    'quantity' => $dataProduct['prd_quantity'],
                    'start_date' => $dataProduct['start_date'],
                    'end_date' => $dataProduct['end_date'],
                    'is_active' => $dataProduct['is_active'],
                ]
            );
            if ($request->hasFile('prd_images')) {
                $slugCategory = optional(Category::query()->find($request->prd_category))->slug ?? "khong-phan-loai";
                foreach ($request->file('prd_images') as $key => $image) {
                    Storage::put("public/products/image_galleries/$slugCategory", $image);
                    ProductImage::query()->create(
                        [
                            'product_id' => $data->id,
                            'image_path' => $prd_img = "products/image_galleries/$slugCategory" . $image->hashName(),
                        ]
                    );
                    $prd_img_temp[$key] = $prd_img;

                }
            }
            if ($request->prd_tags != null) {
                foreach ($request->prd_tags as $idT) {
                    DB::table('product_tag')->insert([
                        'product_id' => $data->id,
                        'tag_id' => $idT,
                    ]);
                }
            }
            if ($productV) {
                foreach ($productV as $idColor => $v) {
                    foreach ($v as $idSize => $itemV) {
                        $prdVariant = $product->product_variants()->create(
                            [
                                'size_attribute_id' => $idSize,
                                'color_attribute_id' => $idColor,
                                'price_default' => $itemV["'price_default'"],
                                'price_sale' => $itemV["'price_sale'"],
                                'start_date' => $itemV["'start_date'"],
                                'end_date' => $itemV["'end_date'"],
                                'quantity' => $itemV["'quantity'"],
                            ]
                        );
                    }
                }
            }
            if ($updateVariants) {
                foreach ($updateVariants as $key => $value) {
                    $modelVariant = ProductVariant::query()->find($key);
                    $modelVariant->update(
                        [
                            'price_default' => $value["'price_default'"] ??= 0,
                            'price_sale' => $value["'price_sale'"] ??= 0,
                            'start_date' => $value["'start_date'"] ??= null,
                            'end_date' => $value["'end_date'"] ??= null,
                            'quantity' => $value["'quantity'"] ??= 0,
                        ]
                    );
                }
            }
            DB::commit();
            if ($request->hasFile('prd_avatar') && $tmpImgThumb && Storage::exists($tmpImgThumb)) {
                Storage::delete($tmpImgThumb);
            }
            return redirect()->route('admin.product.list')->with(['success' => 'Cập nhật sản phẩm thành công!']);
        } catch (\Exception $e) {
            if (isset($dataProduct['prd_avatar']) && $dataProduct['prd_avatar'] != null) {
                Storage::delete($dataProduct['prd_avatar']);
            }
            if (isset($prd_img_temp) && count($prd_img_temp) > 0) {
                foreach ($prd_img_temp as $img) {
                    Storage::delete($img);
                }
            }
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()])->withInput();
        }
    }
    public function delImg(string $id)
    {
        $image = ProductImage::query()->findOrFail($id);
        if ($image->delete()) {
            // Storage::delete($image->image_path);
            return response()->json(['success' => 'Xóa ảnh thành công!']);
        } else {
            return response()->json(['error' => 'Không thể kết nối đến server!'], 500);
        }
    }
    public function delTag(string $id)
    {
        $tags = DB::table('product_tag')->where(['tag_id' => $id]);
        if ($tags->delete()) {
            return response()->json(['success' => 'Xóa tag thành công!']);
        } else {
            return response()->json(['error' => 'Không thể kết nối đến server!'], 500);
        }
    }
    public function delete(string $id)
    {
        $data = ProductVariant::query()->findOrFail($id);
        if ($data->delete()) {
            return redirect()->back()->with(['success' => 'Xóa 1 biến thể thành công!']);
        } else {
            return redirect()->back()->with(['error' => 'Xóa biến thể thất bại!']);
        }
    }
    public function detail(string $slug)
    {
        $data = Product::query()->where(['slug' => $slug])->first();
        return view('admin::contents.products.detail', compact('data'));
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with(['success' => 'Xóa mềm sản phẩm thành công!']);
    }
    public function generateSKU()
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('YmdHi');
        $sku = 'PRD' . '#' . random_int(0, 99999999) . '-' . strtoupper(Str::random(8)) . '-' . $now;
        while (Product::query()->where('sku', $sku)->exists()) {
            $sku = 'PRD' . '#' . random_int(0, 99999999) . '-' . strtoupper(Str::random(8)) . '-' . $now;
        }
        return $sku;
    }
}
