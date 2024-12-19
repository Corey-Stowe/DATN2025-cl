<?php

namespace Modules\Admin\App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;

class CommentController extends Controller
{

public function listComment(Request $request){
    $query = Comment::join('users', 'users.id', '=', 'comments.users_id')
        ->join('products', 'products.id', '=', 'comments.products_id')
        ->select(
            'comments.id',
            'comments.products_id',
            'users.user_name',
            'products.name',
            'comments.comments',
            'comments.rating',
            'comments.comment_date',
            'comments.status'
        );
        
    
    if ($request->has('rating_filter') && $request->get('rating_filter') != '') {
        $query->where('comments.rating', $request->get('rating_filter'));
    }

    if ($request->has('status_filter') && $request->get('status_filter') != '') {
        $query->where('comments.status', $request->get('status_filter'));
    }
    
    $listComment = $query->orderBy('comments.comment_date', 'desc')->paginate(10)->appends($request->except('page'));

    foreach ($listComment as $comment) {
        $commentDate = Carbon::parse($comment->comment_date);
        $comment->isNewComment = $commentDate->diffInDays(Carbon::now()) <= 1;
    }
    return view('admin::contents.comments.listComment', compact('listComment'));
}


public function editComment($id) {
    $detailComment = Comment::join('users', 'users.id', '=', 'comments.users_id')
    ->join('products', 'products.id', '=', 'comments.products_id')
    ->select(
        'comments.id',
        'users.user_name',
        'products.name',
        'comments.comments',
        'comments.rating',
        'comments.comment_date',
        'comments.status'
    )->find($id);
    return view('admin::contents.comments.editComment', compact('detailComment'));
}

public function updateComment($id, Request $request){
    $detailComment = Comment::findOrFail($id);
    
        $detailComment->update([
            'status' => $request['status']
        ]);
        return redirect()->route('admin.comment.listComment');
}
public function bulkAction(Request $request)
{
    $commentIds = $request->input('comment_ids');
    $action = $request->input('action');

    if ($commentIds && $action) {
        switch ($action) {
            case 'approve':
                // Duyệt các comment (status = 2)
                Comment::whereIn('id', $commentIds)->update(['status' => 2]);
                return redirect()->back()->with('success', 'Đã duyệt các bình luận được chọn.');
            case 'hide':
                // Ẩn các comment (status = 3)
                Comment::whereIn('id', $commentIds)->update(['status' => 3]);
                return redirect()->back()->with('success', 'Đã ẩn các bình luận được chọn.');
            default:
                return redirect()->back()->with('error', 'Hành động không hợp lệ.');
        }
    }

    return redirect()->back()->with('error', 'Không có bình luận nào được chọn.');
}


}
