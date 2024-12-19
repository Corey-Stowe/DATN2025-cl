<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showFormAdd(){
        return view('admin.contents.products.showForm');
    }
    public function listProduct(){
        return view('admin.contents.products.listProduct');
    }
}
