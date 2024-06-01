<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;

class PostController extends Controller
{
    public function getallposts(){
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        return response()->json($posts);
    }

    public function createpost(Request $request)
    {
        try {
            // Retrieve the currently authenticated user
            $user = Auth::user();
    
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'content' => 'required|string',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 400);
            }
    
            // Create a new post
            $post = Post::create([
                'content' => $request->content,
                'username' => $user->name,
                'user_id' => $user->id,
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'Post created successfully',
                'post' => $post,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error creating post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getpost(Request $request,$id)
    {
        try {

            $post = Post::find($id);

            if(!$post){
                return response()->json(['message' => 'Post not found'],404);

            }

            return response()->json($post);
           

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function getuser(){
        $user = Auth::user();
        return response()->json($user);
    }
}