<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;
use App\Events\CommentPosted;
use App\Events\PostCreated;
use App\Events\PusherBroadcast;

class PostCommentController extends Controller
{
    public function comments(){
        return view('post.comments');
    }

    public function broadcast(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'post_id' => 'required|integer',
        ]);

        // Get the message and post_id from the request
        $message = $request->get('message');
        $post_id = $request->get('post_id');
        broadcast(new PusherBroadcast($message, $post_id))->toOthers();

        return view('post/broadcast', ['message' => $request->get('message')]);
    }

    public function receive(Request $request)
    {
        
        return view('post/receive', ['message' => $request->get('message')]);
    }
}
