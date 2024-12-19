<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::query()
        ->where('user_id', '=', null)
        ->orderBy('id','desc')
        ->paginate(10);
        return view('admin::contents.notification.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function read()
    {
        $notifications = Notification::query()->where('is_read', '=', 0)->update(['is_read' => 1]);
        if ($notifications) {
            return redirect()->route('admin.notifications.index')->with('success', 'tất cả thông báo đã đươc đọc thành công');
        }else{
            return redirect()->route('admin.notifications.index')->with('info', 'tất cả thông báo đã đươc đọc');

        }
    }

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
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin::edit');
    }

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
