<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserMail;

class UserController extends Controller
{   
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'profile_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

        if ($request->hasFile('profile_img')) {
            $avatarPath = $request->file('profile_img')->store('avatars', 'public');
            $user->profile_img = $avatarPath;
        }

        $user->save();

        // Return success response with additional data
        return response()->json([
            'message' => 'User Created Successfully',
        ], 201);
    }

    public function login(Request $request)
    {
        try {
            // get the user information
            $user = User::where('email', $request->email)->first();
    
            if(empty($user))
            {
                return response()->json([
                    'message' => '404 not found'
                ]);
            }
            
            if(!Hash::check($request->password, $user->password))
            {
                return response()->json([
                    'message' => 'Invalid Credentials'
                ], 404);
            }

            // Generating OTP code   
            $otp = rand(100000, 999999);
            $user->otp_code = Hash::make($otp);
            $user->save();
    
            // send otp code to user login
            // Http::withoutVerifying()->post(env('SEMAPHORE_URI'), [
            //     'apikey' => env('SEMAPHORE_API_KEY'),
            //     'number' => env('SMS_NUMBER'),
            //     'message' => 'Your OTP code is: ' . $otp
            // ]);
            
            Mail::to('j.parrocha@mlgcl.edu.ph')->send(new NewUserMail());

            // return a message
            return response()->json([
                'message' => 'Otp sent successfully',
                'otp_code' => $otp,
            ]);

        } catch (\Exception $sms) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $sms->getMessage()
            ], 500);
        }
    }
    
    public function verifyOtp(Request $request)
    {
        try {

            $request->validate([
                'otp_code' => 'required',
            ]);

            // get the user information
            $user = User::where('email', $request->email)->first();

            // check if the user is not authenticated or the otp code is not hashed
            if (!$user || !Hash::check($request->otp_code, $user->otp_code)) {
                return response()->json([
                    'message' => 'Invalid Credentials'
                ], 401);
            }
            
            $user->otp_code = null;
            $user->save();

            // generating token
            $token = $user->createToken('token');

            // Return a successful response with the token
            return response()->json([
                'status' => true,
                'message' => 'OTP verified successfully',
                'access_token' => $token->plainTextToken
            ], 200);

        } catch (\Exception $sms) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $sms->getMessage()
            ], 500);
        }
    }
    
    public function users()
    {
        return User::limit(10)->orderBy('id', 'desc')->get();
    }

    public function editUser(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $user->role = $request->input('role');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        $user->phone_number = $request->input('phone_number');
        $user->status = $request->input('status');
        $user->gender = $request->input('gender');

        if ($request->hasFile('profile_img')) {
            $avatarPath = $request->file('profile_img')->store('avatars', 'public');
            $user->profile_img = $avatarPath;
        }

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User Updated Successfully',
        ], 201);
    }

    public function profile(Request $request)
    {
        return response()->json($request->user());
    }
    
}
