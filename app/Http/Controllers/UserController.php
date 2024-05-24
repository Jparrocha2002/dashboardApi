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
            // 'profile_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            // 'address' => 'required|string|max:255',
            // 'phone_number' => 'required|string',
            // 'gender' => 'required|string',
            // 'status' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) 
        {
            return response()->json([
                'status' => false,
                'messages' => $validator->errors(),
            ], 400);
        }

        $password = $request->input('password');

        // Create and save the user
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'status' => $request->status,
            'password' => Hash::make($password),
        ]);

        if ($request->hasFile('profile_img')) {
            $avatarPath = $request->file('profile_img')->store('avatars', 'public');
            $user->profile_img = $avatarPath;
        }

        $user->save();

        Mail::to('j.parrocha@mlgcl.edu.ph')->send(new NewUserMail($user, $password));

        // Return success response with additional data
        return response()->json([
            'status' => true,
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

    public function getUser(string $id)
    {
        $user = User::findOrFail($id);

        return response()->json($user);
    }

    public function profile(Request $request)
    {
        return response()->json($request->user());
    }
    
    public function destroy(string $id)
    {
        $users = User::findorFail($id);

        $users->delete();

        return response()->json([
            'status' => true,
            'message' => 'User Deleted Successfully'
        ]);
    }

    // public function countUsers()
    // {
    //     $countUsers = User::query()->count();

    //     return response()->json([
    //         'count' => $countUsers
    //     ]);
    // }
}
