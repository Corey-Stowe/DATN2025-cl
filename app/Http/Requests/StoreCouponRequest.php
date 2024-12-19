<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;


class StoreCouponRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'date_start' => 'required|date|after_or_equal:today',
            'date_end' => 'required|date|after:date_start',
            'code' => [
            'required',
            'string',
            'unique:coupons,code',
            'max:255',
            function ($attribute, $value, $fail) {
                // Loại bỏ dấu tiếng Việt
                $asciiValue = Str::ascii($value);

                // Kiểm tra nếu chuỗi sau khi loại bỏ dấu khác chuỗi ban đầu => Có dấu
                if ($asciiValue !== $value) {
                    return $fail('Mã giảm giá không được có dấu.');
                }

                // Kiểm tra khoảng trắng
                if (preg_match('/\s/', $value)) {
                    return $fail('Mã giảm giá không được chứa khoảng trắng.');
                }

                // Kiểm tra chỉ cho phép chữ và số
                if (!preg_match('/^[A-Za-z0-9]+$/', $value)) {
                    return $fail('Mã giảm giá chỉ được chứa chữ cái và số, không có ký tự đặc biệt.');
                }
            },
        ],
            'description' => 'nullable|string',
            'discount_amount' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) {
                    // Kiểm tra khi discount_type là 'percentage'
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
            'date_start.after_or_equal' => 'Ngày bắt đầu phải là ngày hôm nay hoặc sau ngày hôm nay.',

            'date_end.required' => 'Ngày kết thúc là bắt buộc.',
            'date_end.date' => 'Ngày kết thúc phải là một ngày hợp lệ.',
            'date_end.after' => 'Ngày kết thúc phải sau ngày bắt đầu.',

            'code.required' => 'Mã giảm giá là bắt buộc.',
            'code.string' => 'Mã giảm giá phải là chuỗi ký tự.',
            'code.unique' => 'Mã giảm giá đã tồn tại, vui lòng chọn mã khác.',
            'code.max' => 'Mã giảm giá không được vượt quá 255 ký tự.',


            'description.nullable' => 'Mô tả có thể để trống.',
            'description.string' => 'Mô tả phải là chuỗi ký tự.',

            'discount_amount.required' => 'Giảm giá là bắt buộc!',
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
