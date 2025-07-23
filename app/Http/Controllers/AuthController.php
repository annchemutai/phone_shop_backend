<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string',
            'delivery_address' => 'required|string',
            'role_id'=>'required|integer|exists:roles,id'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        try {
            $user = User::create($validated);

            return response()->json([
                'message' => 'Registration Successful!',
                'user' => $user
            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                "Error" => "Registration failed: ",
                $exception
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        try {
            $user = User::where('email', $validated['email'])->first();
            
            if (!$user || !Hash::check($validated['password'], $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The Provided Credentials are Incorrect.'],
                ]);
            }

            $token = $user->createToken('auth-token')->plainTextToken;
// return $token;
            return response()->json([
                'message' => 'Login Successful!',
                'user' => $user,
                'token' => $token,
                'abilities'=>$user->abilities()
            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                "Error" => "Invalid Credentials !"
            ], 500);
        }
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            "Message"=>"Log Out Successful."
        ]);
    }
}
