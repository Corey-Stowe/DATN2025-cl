<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthenticateController extends Controller
{
    public function showLoginForm()
    {

        return view('admin::authentic.index');
    }
  

    public function PostLogin(Request $req)
    {
        $credentials = $req->only('email', 'password');
        $remember = $req->has('remember');
    
        if (Auth::attempt($credentials, $remember)) {
            return redirect()->route('admin.home'); 
        }
    
        return redirect()->route('login.admin')->with(['error' => 'Đăng nhập thất bại']);
    }
    
    public function logout()
    {
        Auth::logout(); // Đăng xuất người dùng

        return redirect()->route('login.admin')->withErrors('message', 'Đăng xuất thành công');
    }


}
