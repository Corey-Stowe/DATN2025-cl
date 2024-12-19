<?php

namespace Modules\Client\App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Notifications\VerifyEmail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Modules\Client\App\Events\NewUserNotificationEvent;

class RegisterController extends Controller
{

    public function register(Request $request)
    {
        // dd($request->all());
        $message = [
            'full_name.required' => 'Vui lòng nhập họ và tên.',
            'full_name.string' => 'Họ và tên phải là chuỗi ký tự.',
            'full_name.max' => 'Họ và tên không được vượt quá 255 ký tự.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Email này đã được sử dụng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'password.regex' => 'Mật khẩu cần chứa ít nhất 1 chữ, 1 số và 1 ký tự đặc biệt',
            'password_confirmation.required_with' => 'Vui lòng xác nhận mật khẩu.',
            'password_confirmation.same' => 'Mật khẩu xác nhận không khớp với mật khẩu.',
        ];
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required_with:password|same:password'
        ], $message);

        if ($validator->fails()) {
            return redirect()->route('formReg')->withErrors($validator)->withInput();
        }


        $user = User::create([
            'user_name' => null,
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'verify' => '1',
            'status' => 'deactive',
            'user_image' => null,
            'roles_id' => 15,
            'phone' => null,
            'address' => null,
        ]);

        // dd($user);
        if ($user) {
            $notification = " - ID: {$user->id}, Họ và Tên: {$user->full_name}";
            event(new NewUserNotificationEvent($notification));

            $message = [
                'order_id' => null,
                'user_id' => $user->id,
                'full_name' => $request->input('full_name'),
                'message' => 'Tài khoản khách hàng mới ',
            ];

            DB::table('notifications')->insert([
                'user_id' => null,
                'title' => 'Thông báo tài khoản khách hàng mới',
                'message' =>  json_encode($message),
            ]);
        }
        if ($user) {

            // Gửi email xác nhận
            $user->notify(new VerifyEmail());

            // return redirect()->route('verification.verify',$user->id);
        }

        // dd($user);

        // Gửi email xác nhận
        // $user->notify(new VerifyEmail());

        return redirect()->route('showForm')->with('success', 'Đăng ký thành công,vui lòng kiểm tra email để xác minh tài khoản.');
    }
}
