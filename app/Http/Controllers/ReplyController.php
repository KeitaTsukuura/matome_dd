<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;
use App\Http\Requests\ReplyRequest; 

class ReplyController extends Controller
{
    public function store(ReplyRequest $request)
    {
        $userId = auth()->id();
        $reply = new Reply;
        $reply->body = $request->input('reply.body');
        $reply->comment_id = $request->input('comment_id');
        $reply->user_id = $userId;
        
        $reply->save();
    
        
        return redirect()->back();
    }
    public function delete(Reply $reply)
    {
        $reply->delete();
        return redirect()->back();
    }
}
