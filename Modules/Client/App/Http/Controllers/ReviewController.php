<?php

namespace Modules\Client\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function submitReview(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'product_id' => 'required|integer',
            'comments' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Lưu dữ liệu vào bảng comments
        Comment::create([
            'products_id' => $request->product_id,
            'users_id' => auth()->id(),
            'comments' => $request->comments,
            'rating' => $request->rating,
            'comment_date' => now(),
            'status' => 2, // Giả định trạng thái 2 là "hiển thị"
        ]);

        return redirect()->back()->with('success', 'Cảm ơn bạn đã gửi bình luận!');
    }
}
