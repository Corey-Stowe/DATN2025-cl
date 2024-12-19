<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductValidation extends FormRequest
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
    public function rules(): array
    {
        return [
            // validate tên và slug sản phẩm
            'prd_name' => ['required', 'min:5', 'max:255'],
            'prd_slug' => ['required', 'min:5', 'max:255', 'unique:products,slug'],
            // validate giá sản phẩm
            'price_regular' => ['required', 'integer', 'min:1'],
            'price_sale' => ['nullable', 'integer', 'lt:price_regular'],
            'discount_percent' => ['nullable', 'integer', 'min:1', 'max:99'],
            // số lượng
            'prd_quantity' => ['nullable', 'integer', 'min:0'],
            // ngày
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            // ảnh sản phẩm
            'prd_images' => ['nullable', 'array'],
            'prd_images.*' => ['image', 'max:5120', 'distinct'],
            'prd_avatar' => ['required', 'image', 'max:5120'],
        ];
    }
    public function messages(): array
    {
        return [
            // name
            'prd_name.required' => 'Tên sản phẩm không được để trống!',
            'prd_name.min' => 'Tên sản phẩm không được ngắn hơn 5 ký tự!',
            'prd_name.max' => 'Tên sản phẩm không được dài hơn 255 ký tự!',
            'prd_slug.required' => 'Slug sản phẩm không được để trống!',
            'prd_slug.min' => 'Slug sản phẩm không được ngắn hơn 5 ký tự!',
            'prd_slug.max' => 'Slug sản phẩm không được dài hơn 255 ký tự!',
            'prd_slug.unique' => 'Slug sản phẩm đã tồn tại trong hệ thống!',
            // giá
            'price_regular.required' => 'Giá thông thường là bắt buộc và phải lớn hơn 0!',
            'price_regular.integer' => 'Giá thông thường phải là một số nguyên!',
            'price_regular.min' => 'Giá thông thường phải lớn hơn 0!',
            'price_sale.integer' => 'Giá khuyến mãi phải là một số nguyên!',
            'price_sale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá thông thường!',
            'discount_percent.integer' => 'Phần trăm giảm giá phải là một số nguyên!',
            'discount_percent.min' => 'Phần trăm giảm giá phải lớn hơn 0!',
            'discount_percent.max' => 'Phần trăm giảm giá phải nhỏ hơn 99!',
            // số lượng
            'prd_quantity.integer' => 'Số lượng nhập vào phải là số nguyên!',
            'prd_quantity.min' => 'Số lượng nhập vào phải là số nguyên dương!',
            // ngày
            'start_date.date' => 'Ngày bắt đầu phải là một ngày hợp lệ!',
            'end_date.date' => 'Ngày kết thúc phải là một ngày hợp lệ!',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu!',
            // ảnh
            'prd_images.*.image' => 'Mỗi tệp phải là một hình ảnh!',
            'prd_images.*.max' => 'Dung lượng hình ảnh không được vượt quá 5MB!',
            'prd_images.*.distinct' => 'Các hình ảnh không được trùng lặp!',
            'prd_avatar.required' => 'Sản phẩm phải có 1 ảnh đại diện!',
            'prd_avatar.image' => 'File upload phải là file ảnh!',
            'prd_avatar.max' => 'Dung lượng hình ảnh không được vượt quá 5MB!',
        ];
    }
}
