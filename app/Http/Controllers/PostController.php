<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts.index')->with(['posts' => $post->getPaginateBylimit()]);
    }
    public function searchIndex(Request $request, Post $post)
    {
    // キーワードをリクエストから取得
    $keyword = $request->input('keyword');

    // Postモデルのクエリビルダーを取得
    $query = $post->newQuery();

    // キーワードが空でない場合は検索条件を追加
    if (!empty($keyword)) {
        $query->where('title', 'LIKE', "%{$keyword}%");
    }

    // 検索結果を取得
    $posts = $query->orderBy('updated_at', 'DESC')->paginate(5);

    // ビューに検索結果を渡す
    return view('posts.index')->with(['posts' => $posts]);
    }

    public function show($id)
    {
        $post = Post::with('comments')->findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }
    public function create(Category $category)
    {
        return view('posts.create')->with(['categories' => $category->get()]);
    }
    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }
    public function store(PostRequest $request, Post $post)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
}
