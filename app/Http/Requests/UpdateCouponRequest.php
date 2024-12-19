<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $couponId = $this->route('id');

        return [
           'name' => 'required|string|max:255',
        'date_start' => 'required|date',
        'date_end' => 'required|date|after:date_start',
        'code' => [
            'required',
            'string',
            'max:255',
            // Kiểm tra tính duy nhất, bỏ qua mã hiện tại
            Rule::unique('coupons', 'code')->ignore($couponId),
        ],
        'description' => 'nullable|string',
        'discount_amount' => [
            'required',
            'numeric',
            'min:0',
            function ($attribute, $value, $fail) {
                if ($this->discount_type == 'percent' && $value > 100) {
                    return $fail('Giảm giá phần trăm không thể lớn hơn 100.');
                }
            },
        ],
        'discount_type' => 'required|in:percent,fixed',
        'quantity' => 'required|integer|min:1',
        'minimum_spend' => 'required|numeric|min:0',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên mã giảm giá là bắt buộc.',
            'name.string' => 'Tên mã giảm giá phải là chuỗi ký tự.',
            'name.max' => 'Tên mã giảm giá không được vượt quá 255 ký tự.',

            'date_start.required' => 'Ngày bắt đầu là bắt buộc.',
            'date_start.date' => 'Ngày bắt đầu phải là một ngày hợp lệ.',

            'date_end.required' => 'Ngày kết thúc là bắt buộc.',
            'date_end.date' => 'Ngày kết thúc phải là một ngày hợp lệ.',
            'date_end.after' => 'Ngày kết thúc phải sau ngày bắt đầu.',

            'code.required' => 'Mã giảm giá là bắt buộc.',
            'code.string' => 'Mã giảm giá phải là chuỗi ký tự.',
            'code.unique' => 'Mã giảm giá đã tồn tại, vui lòng chọn mã khác.',
            'code.max' => 'Mã giảm giá không được vượt quá 255 ký tự.',


            'description.nullable' => 'Mô tả có thể để trống.',
            'description.string' => 'Mô tả phải là chuỗi ký tự.',

            'discount_amount.required' => 'Giảm giá là bắt buộc.',
            'discount_amount.numeric' => 'Giảm giá phải là một giá trị số.',
            'discount_amount.min' => 'Giảm giá không được nhỏ hơn 0.',

            'discount_type.required' => 'Loại giảm giá là bắt buộc.',
            'discount_type.in' => 'Loại giảm giá phải là "phần trăm" hoặc "cố định".',

            'quantity.required' => 'Số lượng là bắt buộc.',
            'quantity.integer' => 'Số lượng phải là một số nguyên.',
            'quantity.min' => 'Số lượng không được nhỏ hơn 1.',

            'minimum_spend.required' => 'Số tiền chi tiêu tối thiểu là bắt buộc.',
            'minimum_spend.numeric' => 'Số tiền chi tiêu tối thiểu phải là một giá trị số.',
            'minimum_spend.min' => 'Số tiền chi tiêu tối thiểu không được nhỏ hơn 0.',

        ];
    }
}
