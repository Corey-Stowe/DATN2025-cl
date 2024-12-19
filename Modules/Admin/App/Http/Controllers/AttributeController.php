<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeValidation;
use App\Models\ColorAttribute;
use App\Models\SizeAttribute;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
{
    public function listAttr()
    {
        $color = ColorAttribute::query()->get();
        $size = SizeAttribute::query()->get();
        return view('admin::contents.attributes.listAttr', compact('color', 'size'));
    }
    public function addAttr(Request $request)
    {
        $values = $request->values;
        if ($values == null) {
            return redirect()->back()->with(['error' => 'Chưa thêm giá trị thuộc tính, mời kiểm tra lại!']);
        }
        if (!empty(array_filter($values, fn($value) => empty ($value)))) {
            return redirect()->back()->with(['error' => 'Một số giá trị thuộc tính trống, mời kiểm tra lại!']);
        }
        $counts = array_count_values($values);
        $duplicates = array_filter($counts, fn($count) => $count > 1);
        if (!empty($duplicates)) {
            return redirect()->back()->with(['error' => 'Các giá trị trong mảng phải là duy nhất!']);
        }
        $attributeType = $request->sltAttribute;
        $tableMap = [
            'color' => ['table' => 'color_attributes', 'column' => 'color_value'],
            'size' => ['table' => 'size_attributes', 'column' => 'size_value']
        ];
        if (!isset($tableMap[$attributeType])) {
            return redirect()->back()->with(['error' => 'Tên thuộc tính không hợp lệ!']);
        }
        $rules = [];
        $messages = [];
        foreach ($values as $key => $value) {
            $rules["values.$key"] = [
                Rule::unique($tableMap[$attributeType]['table'], $tableMap[$attributeType]['column'])
            ];
            $messages["values.$key.unique"] = "Giá trị '$value' đã tồn tại trong hệ thống!";
        }
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        try {
            DB::beginTransaction();
            foreach ($values as $value) {
                DB::table($tableMap[$attributeType]['table'])->insert([$tableMap[$attributeType]['column'] => $value]);
            }
            DB::commit();
            return redirect()->route('admin.attributes.listAttr')->with(['success' => 'Thêm mới thành công!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Xảy ra lỗi trong quá trình thêm mới!' . $e->getMessage()]);
        }
    }
    public function delValueC(string $id)
    {
        $valueC = ColorAttribute::query()->findOrFail($id);
        if ($valueC->delete()) {
            return response()->json(['success' => 'Xóa giá trị thuộc tính thành công!']);
        } else {
            return response()->json(['error' => 'Không thể kết nối đến server!'], 500);
        }
    }
    public function delValueS(string $id)
    {
        $valueS = SizeAttribute::query()->findOrFail($id);
        if ($valueS->delete()) {
            return response()->json(['success' => 'Xóa mềm giá trị thuộc tính thành công!']);
        } else {
            return response()->json(['error' => 'Không thể kết nối đến server!'], 500);
        }
    }
    public function showFormEdit(string $attr)
    {
        if ($attr == 'color') {
            $dataAttr = ColorAttribute::query()->get();
            $attrName = 'Màu sắc';
        } elseif ($attr == 'size') {
            $dataAttr = SizeAttribute::query()->get();
            $attrName = 'Kích thước';
        }
        return view('admin::contents.attributes.edit', compact('dataAttr', 'attrName'));
    }
    public function update(Request $request, string $attr)
    {
        $dataUpdate = $request->update;
        $dataValues = $request->values;
        $hasEmpty = fn($arr) => !empty (array_filter($arr, fn($val) => empty ($val)));
        if ($hasEmpty($dataUpdate) || ($dataValues && $hasEmpty($dataValues))) {
            return redirect()->back()->withErrors(['error' => 'Một số giá trị thuộc tính trống!']);
        }
        $tableMap = [
            'color' => ['table' => 'color_attributes', 'column' => 'color_value'],
            'size' => ['table' => 'size_attributes', 'column' => 'size_value']
        ];
        if (!isset($tableMap[$attr])) {
            return redirect()->back()->with(['error' => 'Loại thuộc tính không hợp lệ!']);
        }
        if (count($dataUpdate) !== count(array_unique($dataUpdate))) {
            return redirect()->back()->with(['error' => 'Có giá trị thuộc tính bị trùng lặp!']);
        }
        if ($dataValues) {
            $rules = [];
            $messages = [];
            foreach ($dataValues as $key => $value) {
                $rules["values.$key"] = [Rule::unique($tableMap[$attr]['table'], $tableMap[$attr]['column'])];
                $messages["values.$key.unique"] = "Giá trị '$value' đã tồn tại trong hệ thống!";
            }
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
        }
        try {
            DB::transaction(function () use ($dataUpdate, $dataValues, $tableMap, $attr) {
                foreach ($dataUpdate as $key => $value) {
                    DB::table($tableMap[$attr]['table'])->where('id', $key)->update([$tableMap[$attr]['column'] => $value]);
                }
                if ($dataValues) {
                    foreach ($dataValues as $value) {
                        DB::table($tableMap[$attr]['table'])->insert([$tableMap[$attr]['column'] => $value]);
                    }
                }
            });
            return redirect()->back()->with(['success' => 'Cập nhật thuộc tính thành công!']);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => 'Có lỗi trong quá trình thực hiện!']);
        }
    }
}
