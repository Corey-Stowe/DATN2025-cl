<?php

namespace Modules\Client\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function myAccount()
    {
        return view('client::contents.auth.my-account');
    }
    public function form()
    {
        return view('client::contents.auth.log-reg');
    }

    public function form_reg(Request $request)
    {
        return view('client::contents.auth.reg');
    }


}
