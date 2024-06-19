<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GearReply;
use App\Http\Requests\ReplyRequest; 

class GearReplyController extends Controller
{
    public function store(ReplyRequest $request)
    {
        $userId = auth()->id();
        $reply = new GearReply;
        $reply->body = $request->input('reply.body');
        $reply->gear_comment_id = $request->input('comment_id');
        $reply->user_id = $userId;
        
        $reply->save();
    
        
        return redirect()->back();
    }
    public function delete(GearReply $reply)
    {
        $reply->delete();
        return redirect()->back();
    }
}
