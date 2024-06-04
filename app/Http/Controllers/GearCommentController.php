<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GearComment;
use App\Http\Requests\CommentRequest; 

class GearCommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $userId = auth()->id();
        $comment = new GearComment;
        $comment->body = $request->input('comment.body');
        $comment->gear_id = $request->input('gear_id');
        $comment->user_id = $userId;
        
        $comment->save();
    
        
        return redirect()->back()->with('message', 'コメントが保存されました');
    }
    
    public function delete(GearComment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('message', 'コメントが削除されました');
    }
}
