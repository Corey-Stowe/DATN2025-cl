<?php

namespace Modules\Admin\App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CouponModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = CouponModel::select('id', 'name', 'code', 'discount_amount', 'discount_type', 'quantity');
        // dd(datatables($query)->make(true));
        return datatables($query)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $coupon = CouponModel::find($id);

        // Kiểm tra nếu coupon tồn tại
        if (!$coupon) {
            return response()->json(['message' => 'Coupon not found'], 404);
        }
        // Xóa coupon
        $coupon->delete();

        // Trả về phản hồi thành công
        return response()->json(['message' => 'Coupon deleted successfully'], 200);
    }
}
