<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{   
    public function store(Request $request)
    {
         // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Create and save the user
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->save();

        // Return success response with additional data
        return response()->json([
            'message' => 'User Created Successfully',
        ], 201);
    }

     public function login(Request $request)
    {
        if(auth()->attempt($request->only(['email', 'password'])))
        {            
            $token = auth()->user()->createToken('Test');
            return response()->json([
                'user' => auth()->user(),
                'access_token' => $token->plainTextToken,
                'message' => 'Login Successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid credentials'
            ]); 
        }
    }
    
    public function users()
    {
        return User::limit(10)->orderBy('id', 'desc')->get();
    }
}
