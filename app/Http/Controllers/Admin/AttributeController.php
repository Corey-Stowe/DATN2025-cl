<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function listAttr()
    {
        return view('admin.contents.attributes.listAttr');
    }
    public function addAttr()
    {
        return view('admin.contents.attributes.addAttr');
    }
}
