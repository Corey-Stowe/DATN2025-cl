<?php

namespace Modules\Client\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ForgotPasswordClient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function forgotPasswordForm()
    {
        return view('client::contents.auth.passwords.email');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function sendResetLinkEmail(Request $request)
    {
        // Kiểm tra email


        $request->validate(
            ['email' => 'required|email'],
            [
                'required' => 'email không được để trống.',
                'email' => 'email phải là một địa chỉ email hợp lệ.',
            ]
        );
        $email = User::where('email', $request->email)->first();

        if (!$email) {
            return back()->withErrors(['email' => 'Email không tồn tại.']);
        } else {
            $email->notify(new ForgotPasswordClient());
        }

        return redirect()->route('forgot-password')->with('message', 'Email đã được gửi. Vui lòng kiểm tra email của bạn.');
    }
}
