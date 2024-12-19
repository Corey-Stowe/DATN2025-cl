<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Str;

class TagController extends Controller
{
    public function index()
    {
        $data = Tag::query()->get();
        return view('admin::contents.tags.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate(
            ['name' => 'required|unique:tags,name'],
            ['name.required' => 'Không được để tên thẻ trống!', 'name.unique' => 'Tên thẻ đã tồn tại trong hệ thông!']
        );
        try {
            DB::beginTransaction();
            Tag::query()->create(['name' => $request->name, 'slug' => Str::slug($request->name)]);
            DB::commit();
            return redirect()->route('admin.tags.list')->with(['success' => 'Thêm mới 1 tag thành công!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Thêm thẻ thất bại! - Lỗi: ' . $e->getMessage()]);
        }
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
    public function destroy(string $slug)
    {
        $data = Tag::query()->where('slug', $slug)->firstOr();
        if ($data->delete()) {
            return redirect()->route('admin.tags.list')->with(['success' => 'Xóa  1 tag thành công!']);
        } else {
            return redirect()->back()->with(['error' => 'Xóa 1 tag thất bại!']);
        }
    }
}
