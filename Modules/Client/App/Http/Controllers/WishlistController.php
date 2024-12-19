<?php

namespace Modules\Client\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Wishlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('showForm');
        }

        $data = Wishlist::query()
            ->with('productVariant')
            ->with("productVariant.size")
            ->with("productVariant.color")
            ->with("product")
            ->where('user_id', auth()->id())
            ->get();
        // dd($data);
        return view('client::contents.shops.wishlist', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'bạn chưa đăng nhập!'], 200);
        }

        if ($request->color_attribute_id == null || $request->size_attribute_id == null) {
            return response()->json(['message' => ' vui lòng kiểu sản phẩm'], 200);
        }
        $productId = $request->product_id;
        $productVariantId = ProductVariant::query()
            ->where('product_id', '=', $productId)
            ->where('color_attribute_id', '=', $request->color_attribute_id)
            ->where('size_attribute_id', '=', $request->size_attribute_id)
            ->first()->id;

        // $wishList = Wishlist::query()->firstOrCreate(['product_id' => $productId, 'product_variant_id' => $productVariantId, 'user_id' => auth()->id()]);

        $wishList = Wishlist::where([
            'product_id' => $productId,
            'product_variant_id' => $productVariantId,
            'user_id' => auth()->id()
        ])->first();

        if ($wishList) {
            return response()->json(['message' => 'Bạn đã thêm sản phẩm này rồi'], 200);
        } else {
            Wishlist::create([
                'product_id' => $productId,
                'product_variant_id' => $productVariantId,
                'user_id' => auth()->id(),
            ]);
            return response()->json(['message' => 'Thêm sản phẩm vào danh sách yêu thích thành công'], 200);
        };
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $wishlist = Wishlist::query()->find($id);
        if ($wishlist) {
            $wishlist->delete();
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Xóa sản phẩm khỏi danh sách yêu thích thành công'
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Xóa sản phẩm khỏi danh sách yêu thích thất bại'
                ],
                200
            );
        }
    }
}
