<?php

namespace Modules\Admin\App\Http\Controllers\Api;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::query()->orderBy('id', 'desc')->take(5)->get();
        return response()->json($notifications, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function read()
    {
        try {
            $updated = Notification::where('is_read', 0)->update(['is_read' => 1]);

            if ($updated > 0) {
                return response()->json([
                    'success' => true,
                    'message' => 'Đã đánh dấu tất cả thông báo là đã đọc thành công.',
                    'updated_count' => $updated
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy thông báo chưa đọc.'
                ], 404);
            }
        } catch (\Exception $e) {
            // Ghi lại lỗi vào log
            Log::error('Lỗi khi đánh dấu thông báo là đã đọc: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi. Vui lòng thử lại sau.'
            ], 500);
        }
    }

    public function unreadCount()
    {
        $unreadCount = Notification::query()->where('is_read','=',0)->count();
        return response()->json(['unread_count' => $unreadCount]);
    }
}
