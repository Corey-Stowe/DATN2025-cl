<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin::user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {

        $statusOrder = Order::STATUS_ORDER;
        $statusPayment = Order::STATUS_PAYMENT;
        $userOrder = Order::query()
            ->select(
                'orders.id as id',
                'orders.status_order as status_order',
                'orders.payment_method as payment_method',
                'orders.status_payment as status_payment',
                'orders.total_price as total_price',
                'orders.date_create_order as date_create_order',
                'orders.shipping_method as shipping_method',
            )
            ->where('users_id', '=', $id)
            ->paginate(5);
        // ->get();
        // dd($userOrder);
        $user = User::query()
            ->select(
                'users.id as id',
                'users.user_name as user_name',
                'users.full_name as full_name',
                'users.phone as phone',
                'users.email as email',
                'users.password as password',
                'users.address as address',
                'users.user_image as user_image',
                'users.roles_id as roles_id',
                'roles.role_type as role_type',
                'users.status as status',
                'users.verify as verify'
            )
            ->join('roles', 'users.roles_id', '=', 'roles.id')
            ->where('users.id', '=', $id)
            ->first();

        // dd($user);
        if ($user) {
            return view('admin::user.show', compact('user', 'userOrder', 'statusOrder', 'statusPayment'));
        } else {
            return redirect()->route('admin.users.index')->with('info', 'Tài khoản không tồn tại.');
        }
    }

    public function UpdateStatus(Request $request, $id): RedirectResponse
    {
        $user = User::find($id);
        if ($user) {
            $user->status = $request->status;
            $user->save();
            return redirect()->route('admin.users.show', $id)->with('success', 'Cập nhật trạng thái thành công.');
        } else {
            return redirect()->route('admin.users.index')->with('info', 'Tài khoản không tồn tại.');
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
