<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function listOrder()
    {
        return view('admin.contents.orders.orderlist');
    }
    public function orderDetail()
    {
        return view('admin.contents.orders.orderDetail');
    }
    public function orderTracking()
    {
        return view('admin.contents.orders.tracking');
    }
}
