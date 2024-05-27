<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\CommentRequest; 

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $userId = auth()->id();
        $comment = new Comment;
        $comment->body = $request->input('comment.body');
        $comment->post_id = $request->input('post_id');
        $comment->user_id = $userId;
        
        $comment->save();
    
        
        return redirect()->back()->with('message', 'コメントが保存されました');
    }
    
    public function delete(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('message', 'コメントが削除されました');
    }
}
