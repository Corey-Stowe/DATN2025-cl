<?php

namespace Modules\Client\App\Http\Controllers;



use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showResetForm(Request $request, $token)
    {
        return view('client::contents.auth.passwords.reset',['token'=>$token, 'email'=> $request->email]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:8|confirmed'
        ]);
        $status = Password::reset(
            $request->only('email','password','password_confirmation','token'),
            function ($user,$password){
                $user->password = Hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();
            }
        );
        // dd($status);

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('showForm')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    /**
     * Store a newly created resource in storage.
     */
    
}
