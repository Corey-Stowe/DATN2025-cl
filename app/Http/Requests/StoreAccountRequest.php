<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
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
            'user_name' => 'required|string|max:255|unique:users,user_name',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            're_enter_password' => 'required|same:password',
            'address' => 'nullable|string|max:255',
            'roles' => 'required|exists:roles,id',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => 'Vui lòng nhập tên người dùng.',
            'user_name.string' => 'Tên người dùng phải là chuỗi ký tự.',
            'user_name.max' => 'Tên người dùng không được vượt quá 255 ký tự.',
            'user_name.unique' => 'Tên người dùng đã tồn tại, vui lòng chọn tên khác.',

            'full_name.required' => 'Vui lòng nhập họ và tên.',
            'full_name.string' => 'Họ và tên phải là chuỗi ký tự.',
            'full_name.max' => 'Họ và tên không được vượt quá 255 ký tự.',

            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.string' => 'Số điện thoại phải là chuỗi ký tự.',
            'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',

            'email.required' => 'Vui lòng nhập email.',
            'email.string' => 'Email phải là chuỗi ký tự.',
            'email.email' => 'Vui lòng nhập địa chỉ email hợp lệ.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'email.unique' => 'Email đã được sử dụng, vui lòng chọn email khác.',

            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',

            're_enter_password.required' => 'Vui lòng nhập lại mật khẩu.',
            're_enter_password.same' => 'Mật khẩu xác nhận không khớp với mật khẩu đã nhập.',

            'address.string' => 'Địa chỉ phải là chuỗi ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',

            'roles.required' => 'Vui lòng chọn vai trò.',
            'roles.exists' => 'Vai trò được chọn không hợp lệ.',

            'img.image' => 'Tập tin phải là định dạng hình ảnh.',
            'img.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'img.max' => 'Hình ảnh không được vượt quá 2MB.',
        ];
    }
}
