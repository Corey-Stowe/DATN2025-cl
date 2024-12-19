<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function listAccounts()
    {
        return view('admin.contents.authentication.listAcc');
    }
}
