<?php

namespace Modules\Client\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\VerifyEmail;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Socialite\Facades\Socialite;
use Str;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('client::contents.auth.log-reg');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            return redirect()->route('index');
        }
        return redirect()->back()->withErrors(['Error' => 'Email hoặc mật khẩu không chính xác']);
    }
    // đăng nhập với Google ===================================================
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
            } else {
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'full_name' => $user->name,
                    'google_id' => $user->id,
                    'roles_id' => 15,
                    'verify' => 1,
                    'status' => 'active',
                    'password' => encrypt($this->genPassGoogle()),
                ]);
                if ($newUser) {
                    Auth::login($newUser);
                } else {
                    return redirect()->back()->withErrors(['error' => 'Xảy ra lỗi trong quá trình thực hiện!']);
                }
            }
            return redirect()->route('index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    protected function genPassGoogle()
    {
        $pass = Str::random(6) . Str::random(6) . Str::random(6);
        return $pass;
    }
}
