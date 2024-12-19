<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function listCategories()
    {
        $data = Category::all();
        $data2 = SubCategory::paginate(8);
        return view('admin::contents.categories.list', compact('data', 'data2'));
    }
    public function edit_pl(string $slug)
    {
        $data = Category::query()->where('slug', $slug)->firstOr();
        // dd($data);
        return view('admin::contents.categories.edit', compact('data'));
    }
    public function edit_dm(string $slug)
    {
        $data = SubCategory::query()->where('slug', $slug)->firstOr();
        $ctg = Category::query()->get();
        return view('admin::contents.categories.editSub', compact('data', 'ctg'));
    }
    public function update_pl(Category $category, Request $request)
    {
        $validator = $request->validate(
            [
                'note' => 'nullable|regex:/^[^<>]*$/',
                'img_cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'name' => [
                    'required',
                    'min:2',
                    'max:100',
                    'regex:/^[^<>]*$/',
                    Rule::unique('categories', 'name')->ignore($category->id), // Loại trừ ID đang cập nhật
                ],
            ],
            [
                'name.required' => 'Tên loại không được để trống!',
                'name.unique' => 'Tên loại đã tồn tại trong hệ thống!',
                'name.min' => 'Tên loại có độ dài ký tự tối thiểu 2 ký tự!',
                'name.max' => 'Tên loại có độ dài tối đa 100 ký tự!',
                'name.regex' => 'Không được nhập dữ liệu có định dạng HTML!',
                'img_cover.image' => 'File tải lên phải là hình ảnh!',
                'img_cover.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, svg!',
                'img_cover.max' => 'Dung lượng tối đa của hình ảnh là 2MB!',
            ]
        );

        $img = null;
        try {
            DB::beginTransaction();

            if ($request->hasFile('img_cover_update')) {
                $img = Storage::put('categories', $request->file('img_cover_update'));
            } else {
                $img = $category->image_cover;
            }

            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'note' => $request->note ?? 'Chưa cập nhật mô tả chi tiết!',
                'image_cover' => $img,
            ]);

            DB::commit();
            return redirect()->route('admin.categories.list')->with('success', 'Cập nhật thông tin thành công!');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', $exception->getMessage());
        }
    }
    public function update_dm(SubCategory $subCategory, Request $request)
    {
        // dd($subCategory);
        $validator = $request->validate(
            [
                'note' => 'nullable|regex:/^[^<>]*$/',
                'name' => [
                    'required',
                    'min:2',
                    'max:100',
                    'regex:/^[^<>]*$/',
                    Rule::unique('sub_categories', 'name')->ignore($subCategory->id), // Loại trừ ID đang cập nhật
                ],
            ],
            [
                'name.required' => 'Tên loại không được để trống!',
                'name.unique' => 'Tên loại đã tồn tại trong hệ thống!',
                'name.min' => 'Tên loại có độ dài ký tự tối thiểu 2 ký tự!',
                'name.max' => 'Tên loại có độ dài tối đa 100 ký tự!',
                'name.regex' => 'Không được nhập dữ liệu có định dạng HTML!',
            ]
        );

        $img = null;
        try {
            DB::beginTransaction();

            $subCategory->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'note' => $request->note ?? 'Chưa cập nhật mô tả chi tiết!',
            ]);

            DB::commit();
            return redirect()->route('admin.categories.list')->with('success', 'Cập nhật thông tin thành công!');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', $exception->getMessage());
        }
    }
    public function destroy(Category $category)
    {
        if ($category->delete()) {
            return redirect()->route('admin.categories.list')->with('success', 'Xóa thành công danh mục!');
        } else {
            return redirect()->back()->with('error', 'Xóa thất bại danh mục!');
        }
    }
    public function phan_loai(Request $request)
    {
        // dd($request->all());
        $validator = $request->validate(
            [
                'name' => 'required|unique:categories,name|min:2|max:100|regex:/^[^<>]*$/',
                'note' => 'nullable|regex:/^[^<>]*$/',
                'img_cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'name.required' => 'Tên loại không được để trống!',
                'name.unique' => 'Tên loại đã tồn tại trong hệ thống!',
                'name.min' => 'Tên loại có độ dài ký tự tối thiểu 2 ký tự!',
                'name.max' => 'Tên loại có độ dài tối đa 100 ký tự!',
                'name.regex' => 'Không được nhập dữ liệu có định dạng HTML!',
                'img_cover.image' => 'File tải lên phải là hình ảnh!',
                'img_cover.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, svg!',
                'img_cover.max' => 'Dung lượng tối đa của hình ảnh là 2MB!',
            ]
        );
        $img = null;
        try {
            DB::beginTransaction();
            if ($request->hasFile('img_cover')) {
                $img = Storage::put('categories', $request->file('img_cover'));
            }
            Category::query()->create(
                [
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'note' => $request->note ??= 'Chưa cập nhật mô tả chi tiết!',
                    'image_cover' => $img,
                ]
            );
            DB::commit();
            return redirect()->route('admin.categories.list')->with('success', 'Thêm mới danh mục thành công!');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }
    public function danh_muc(Request $request)
    {
        $validator = $request->validate(
            [
                'name_sub' => 'required|unique:sub_categories,name|min:2|max:100|regex:/^[^<>]*$/',
                'note_sub' => 'nullable|regex:/^[^<>]*$/',
                'id_phan_loai' => 'required',
            ],
            [
                'name_sub.required' => 'Tên loại không được để trống!',
                'name_sub.unique' => 'Tên loại đã tồn tại trong hệ thống!',
                'name_sub.min' => 'Tên loại có độ dài ký tự tối thiểu 2 ký tự!',
                'name_sub.max' => 'Tên loại có độ dài tối đa 100 ký tự!',
                'name_sub.regex' => 'Không được nhập dữ liệu có định dạng HTML!',
                'id_phan_loai.required' => 'Vui lòng chọn danh mục lớn!',
            ]
        );
        try {
            DB::beginTransaction();
            SubCategory::query()->create([
                'category_id' => $request->id_phan_loai ??= null,
                'name' => $request->name_sub,
                'slug' => Str::slug($request->name_sub),
                'note' => $request->note_sub ??= 'Chưa cập nhật ghi chú chi tiết!',
            ]);
            DB::commit();
            return redirect()->route('admin.categories.list')->with('success', 'Thêm mới 1 danh mục thành công!');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }
    public function destroySub(SubCategory $subCategory)
    {
        if ($subCategory->delete()) {
            return redirect()->route('admin.categories.list')->with('success', 'Xóa thành công danh mục phụ!');
        } else {
            return redirect()->back()->with('error', 'Xóa thất bại danh mục phụ!');
        }
    }
}
