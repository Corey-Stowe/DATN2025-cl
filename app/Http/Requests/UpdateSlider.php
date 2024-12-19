<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSlider extends FormRequest
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
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'title' => 'required|min:5|max:255|regex:/^[^<>]*$/',
            'offer_text' => 'nullable|max:255|regex:/^[^<>]*$/',
            'description' => 'nullable|max:255|regex:/^[^<>]*$/',
        ];
    }
    public function messages()
    {
        return [
            // hình ảnh
            'hinh_anh.image' => 'File tải lên phải là hình ảnh!',
            'hinh_anh.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, svg!',
            'hinh_anh.max' => 'Dung lượng hình ảnh không được vượt quá 5MB!',
            // tiêu đề
            'title.required' => 'Tiêu đề không được để trống!',
            'title.min' => 'Tiêu đề phải có ít nhất 5 ký tự!',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự!',
            'title.regex' => 'Tiêu đề không được chứa thẻ HTML!',
            // nội dung
            'offer_text.max' => 'Nội dung ưu đãi không được vượt quá 255 ký tự!',
            'offer_text.regex' => 'Nội dung ưu đãi không được chứa thẻ HTML!',
            // mô tả
            'description.max' => 'Mô tả không được vượt quá 255 ký tự!',
            'description.regex' => 'Mô tả không được chứa thẻ HTML!',
        ];
    }
}
