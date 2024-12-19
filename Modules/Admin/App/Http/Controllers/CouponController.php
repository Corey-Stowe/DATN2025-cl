<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
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
        return view('admin::coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin::coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCouponRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Tạo coupon mới
        $res = CouponModel::create($data);
        if ($res) {
            // Redirect về trang danh sách với thông báo thành công
            return redirect()->route('admin.coupons.index')->with('success', 'Coupon đã được thêm mới!');
        }else {
             // Redirect về trang danh sách với thông báo không thành công
             return redirect()->route('admin.coupons.index')->with('error', 'Coupon không được thêm mới!');
        }
        
    
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {   
        $coupon = CouponModel::find($id);
        // dd($coupon);
        if ($coupon) {
            return view('admin::coupon.show', compact('coupon'));
        } else {
            return redirect()->route('admin.coupons.index')->with('info', 'Mã giảm giá không tồn tại.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {   

        $coupon = CouponModel::find($id);
        if ($coupon) {
            return view('admin::coupon.edit', compact('coupon'));
        } else {
            return redirect()->route('admin.coupons.index')->with('info', 'Mã giảm giá không tồn tại.');
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCouponRequest $request, $id): RedirectResponse
    {
        $coupon = CouponModel::findOrFail($id);
        $data = $request->validated();
        $coupon->update($data);
        return redirect()->route('admin.coupons.edit',['id' => $id])->with('success', 'Mã giảm giá đã được cập nhật thành công.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
