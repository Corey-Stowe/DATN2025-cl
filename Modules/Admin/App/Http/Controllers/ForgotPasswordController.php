<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Models\User;
use App\Notifications\ForgotPasswordAdmin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Modules\Admin\App\Notifications\AdminResetPassword;

class ForgotPasswordController extends Controller
{
    public function forgotPassword()
    {
        return view('admin::contents.forgot-password.forgot-password');
    }

    public function postForgotPassword(Request $request): RedirectResponse
    {


        $request->validate(['email' => 'required|email']);

        $email = $request->email;
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email không tồn tại trong hệ thống.']);
        } else {
            if ($user->roles_id != 2) {
                $user->notify(new ForgotPasswordAdmin());
                return redirect()->route('admin.confirm.mail')->with('email', $email);
            } else {
                return redirect()->back()->with('error', 'Email không tồn tại trong hệ thống.');
            }
        }
    }
  
    public function resetPassword(Request $request, $token)
    {
        return view('admin::contents.forgot-password.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    public function postResetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/',
            // 'password_confirmation' => 'required_with:password|same:password',
        ], [
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'password.regex' => 'Mật khẩu cần chứa ít nhất 1 chữ, 1 số và 1 ký tự đặc biệt',

            // 'password_confirmation.required_with' => 'Vui lòng xác nhận mật khẩu.',
            // 'password_confirmation.same' => 'Mật khẩu xác nhận không khớp với mật khẩu.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();
            }
        );
        return redirect()->route('login.admin')->with('status', 'Mật khẩu đã được cập nhật thành công.');


        // return $status === Password::PASSWORD_RESET
        //     ? redirect()->route('login.admin')->with('status', __($status))
        //     : back()->withErrors(['email' => [__($status)]]);

       
    }

    public function confirmMail()
    {
        return view('admin::contents.forgot-password.confirm-mail');
    }
}
