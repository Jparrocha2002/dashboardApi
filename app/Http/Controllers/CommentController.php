<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    //
    public function createComment(Request $request)
    {
        try {
            
            $validateUser = Validator::make($request->all(), 
            [
                'comment' => 'required',
              
        
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

         

            Comment::create([
                'comment'=> $request->comment,   
                'post_id' => $request->post_id,
                'user_id'=> $request->user_id,
                
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Comment save!',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }



    public function getcomment($postId)
    {
        $comments = Comment::where('post_id', $postId)->with('user')->get();
        return response()->json($comments);
    }
}