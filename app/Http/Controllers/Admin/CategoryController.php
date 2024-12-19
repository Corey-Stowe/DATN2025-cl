<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function listCategories()
    {
        return view('admin.contents.categories.list');
    }
    // public function addCategory()
    // {
    //     return view('admin.contents.categories.addCategory');
    // }
}
