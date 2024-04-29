<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // If validation fails, return error response
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 401);
        }      

        // Create and save the user
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->save();

        // Return success response
        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function login(Request $request)
    {

        if(auth()->attempt($request->only(['email', 'password'])))
        {            
            $token = auth()->user()->createToken('Test');
            return response()->json([
                'user' => auth()->user(),
                'access_token' => $token->plainTextToken,
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

    public function home() 
    {
        return view('home');
    }
}
