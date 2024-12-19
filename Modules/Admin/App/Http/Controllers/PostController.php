<?php

namespace Modules\Admin\App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('admin::contents.posts.list_blog', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin::contents.posts.create_post');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string',
            'slug_post' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[a-z0-9-]+$/', Rule::unique('posts', 'slug_post'),],
            'published_id' => 'required|boolean',
            'created_at' => 'required|date',
            'image_post' => 'nullable|image|max:2048',
            'content' => 'required|string',
        ], [
            // Custom error messages (optional)
            'title.required' => 'Tiêu đề là bắt buộc.',
            'short_description.required' => 'Mô  tả ngắn là bắt buộc.',
            'slug_post.required' => 'Slug là bắt buộc.',
            'slug_post.unique' => 'Slug đã tồn tại, vui lòng chọn slug khác.',
            'published_id.required' => 'Trạng thái là bắt buộc.',
            'created_at.required' => 'Ngày tạo là bắt buộc.',
            'content.required' => 'Nội dung bài viết là bắt buộc.',
            'image_post.image' => 'Tệp tải lên phải là hình ảnh.',
            'image_post.mimes' => 'Hình ảnh phải thuộc định dạng: jpeg, png, jpg, gif.',
        ]);
        if ($request->hasFile('image_post')) {
            $imgPost = $request->file('image_post')->store('uploads/Post', 'public');
            //dd($imgCate);
        } else {
            $imgPost = null;
        }
        $post = Post::create([
            'title' => $validatedData['title'],
            'short_description' => $validatedData['short_description'],
            'slug_post' => $validatedData['slug_post'],
            'published_id' => $validatedData['published_id'],
            'image_post' => $imgPost,
            'created_at' => $validatedData['created_at'],
            'content' => $validatedData['content'],
        ]);
        return redirect()->route('admin.posts.list');
    }

    /**
     * Show the specified resource.
     */
    public function show($slug)
    {
        $listPost = Post::where('slug_post', $slug)->first();
        return view('admin::contents.posts.show_post', compact('listPost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        // $posts = Post::where('');
        $listPost = Post::where('slug_post', $slug)->first();
        // dd($listPost);
        return view('admin::contents.posts.edit', compact('listPost'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $listPost = Post::findOrFail($id);
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string',
            'slug_post' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[a-z0-9-]+$/',],
            'published_id' => 'required|boolean',
            'created_at' => 'required|date',
            'image_post' => 'nullable|image|max:2048',
            'content' => 'required',
        ], [
            // Custom error messages (optional)
            'title.required' => 'Tiêu đề là bắt buộc.',
            'short_description.required' => 'Mô tả ngắn là bắt buộc.',
            'slug_post.required' => 'Slug là bắt buộc.',
            'published_id.required' => 'Trạng thái là bắt buộc.',
            'created_at.required' => 'Ngày tạo là bắt buộc.',
            'content.required' => 'Nội dung bài viết là bắt buộc.',
            'image_post.image' => 'Tệp tải lên phải là hình ảnh.',
            'image_post.mimes' => 'Hình ảnh phải thuộc định dạng: jpeg, png, jpg, gif.',
        ]);
        if ($request->hasFile('image_post')) {
            if ($listPost->image_post) {
                Storage::disk('public')->delete($listPost->image_post);
            }

            $imgPost = $request->file('image_post')->store('uploads/listPost', 'public');
        } else {
            $imgPost = $listPost->image_post;
        }
        ;
        $listPost->update([
            'title' => $validatedData['title'],
            'short_description' => $validatedData['short_description'],
            'slug_post' => $validatedData['slug_post'],
            'published_id' => $validatedData['published_id'],
            'image_post' => $imgPost,
            'created_at' => $validatedData['created_at'],
            'content' => $validatedData['content'],
        ]);
        return redirect()->route('admin.posts.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();
        return redirect()->route('admin.posts.list');
    }
}
