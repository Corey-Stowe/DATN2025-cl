<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSlide;
use App\Http\Requests\UpdateSlider;
use App\Models\Banner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Exception;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = new Banner();
        $banner = $data->getBanner();
        $bannerMKT = Banner::query()->where('banner_position', 3)->limit(2)->get();
        $bannerMKT4 = Banner::query()->where('banner_position', 4)->first();
        return view('admin::contents.banner.list')->with(compact('bannerMKT', 'bannerMKT4', 'banner'));
    }
    public function slider()
    {
        $data = new Banner();
        $slider = $data->getSliderPosition();
        return view('admin::contents.banner.slider')->with(compact('slider'));
    }
    public function update(UpdateSlider $request, Banner $banner)
    {
        try {
            DB::beginTransaction();
            $img = $banner->img_banner;
            if ($request->hasFile('hinh_anh')) {
                $img = Storage::put('public/slider', $request->file('hinh_anh'));
            }
            $banner->update(
                [
                    'img_banner' => $img,
                    'link' => $request->lien_ket,
                    'banner_position' => 1,
                    'offer_text' => $request->offer_text,
                    'title' => $request->title,
                    'description' => $request->description,
                ]
            );
            DB::commit();
            return redirect()->route('admin.banner.slider')->with('success', 'Cập nhật thành công!');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
    public function cap_nhat(Request $request, Banner $banner)
    {
        // dd($request->all());
        $request->validate(
            [
                'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'banner_position' => 'required|in:3,4',
            ],
            [
                'hinh_anh.image' => 'File tải lên phải là hình ảnh!',
                'hinh_anh.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, svg!',
                'hinh_anh.max' => 'Dung lượng hình ảnh không được vượt quá 5MB!',
                'banner_position.in' => 'Vị trí banner phải là 3 hoặc 4!',
                'banner_position.required' => 'Vị trí banner là bắt buộc!',
            ]
        );
        $img = $banner->img_banner;
        $imgTEMP = $banner->img_banner;
        try {
            DB::beginTransaction();
            if ($request->hasFile('hinh_anh')) {
                $img = Storage::put('public/banner', $request->file('hinh_anh'));
                //dd($img);
            };
            $banner->update(
                [
                    'img_banner' => $img,
                    'link' => $request->lien_ket,
                    'banner_position' => $request->banner_position,
                    'offer_text' => $request->offer_text,
                    'title' => $request->title,
                    'description' => $request->description,
                ]
            );
            DB::commit();
            if ($request->hasFile('hinh_anh') && $imgTEMP) {
                Storage::delete($imgTEMP);
            }
            return redirect()->back()->with('success', 'Cập nhật thành công!');
        } catch (\Exception $exception) {
            Storage::delete($img);
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
           // dd($exception->getMessage());
        }
    }
    public function delete($id)
    {
        $data = new Banner();
        $banner = $data->deleteBanner($id);
        if ($banner) {
            return redirect()->route('admin.banner.list')->with('success', 'Xóa banner thành công');
        } else {
            return redirect()->route('admin.banner.list')->with('error', 'Xóa banner thất bại');
        }
    }
    public function add($position, StoreSlide $request)
    {
        try {
            DB::beginTransaction();
            if ($position == 1) {
                $img = Storage::put('public/slider', $request->hinh_anh);
                $model = new Banner();
                $model->Addbanner($img, $request->lien_ket, $position, $request->offer_text, $request->title, $request->description);
            }
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật thành công!');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
