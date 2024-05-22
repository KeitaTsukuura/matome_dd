<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\CommentRequest; 

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $comment = new Comment;
        $comment->body = $request->input('comment.body');
        $comment->post_id = $request->input('post_id');

        $comment->save();
    
        
        return redirect()->back()->with('message', 'コメントが保存されました');
    }
}
