<?php

namespace Modules\Client\App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('published_id', 1)->latest('created_at')->paginate(5);
        //dd($posts);
        // Trả về view với danh sách bài viết
        return view('client::contents.other-pages.post', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

    }

    /**
     * Show the specified resource.
     */
    public function show($slug)
    {
        $post = Post::where(['slug_post' => $slug, 'published_id' => 1])->first();
        $posts = Post::where('published_id', 1)->latest('created_at')->get(); // Lấy tất cả bài viết
        return view('client::contents.other-pages.post-detail', compact('post', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('client::edit');
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
    // Tìm kiếm bài viết theo tiêu đề (Title)
    public function search(Request $request)
{
    $query = $request->search_input;

    // Kiểm tra nếu người dùng không nhập gì vào ô tìm kiếm
    if (empty(trim($query))) {
        return view('client::contents.other-pages.post', [
            'data' => null, // Không có kết quả tìm kiếm
            'posts' => null, // Không hiển thị bài viết gần đây
            'error' => 'Vui lòng nhập từ khóa để tìm kiếm!' // Thông báo lỗi
        ]);
    }

    // Lấy danh sách bài viết đã xuất bản
    $posts = Post::where('published_id', true)->latest()->paginate(5);

    // Tìm kiếm bài viết theo tiêu đề
    $data = Post::where('published_id', true)
                ->where('title', 'like', '%' . $query . '%')
                ->get();

    // Nếu không có kết quả tìm kiếm
    if ($data->isEmpty()) {
        return view('client::contents.other-pages.post', [
            'data' => null, // Không có kết quả tìm kiếm
            'posts' => $posts, // Danh sách bài viết gần đây
            'error' => 'Không tìm thấy bài viết nào phù hợp!' // Thông báo lỗi
        ]);
    }

    // Nếu có kết quả tìm kiếm
    return view('client::contents.other-pages.post', [
        'data' => $data, // Kết quả tìm kiếm
        'posts' => null, // Không hiển thị bài viết gần đây
        'error' => null // Không có lỗi
    ]);
}


}
