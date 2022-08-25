<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Authcontroller extends Controller
{
    public function login(Request $request)
    {
        try {
            $validate = validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required'
            ]);

            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validate errors',
                    'error' => $validate->errors()
                ], 401);
            }
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json()([
                    'status' =>  false,
                    'message' => 'username or password in correct'
                ], 401);
            }
            $user = User::where('email', $request->email)->first();
            return response()->json([
                'user' => $user,
                'status' => true,
                'message' => 'Login Success',
                'token' => $user->createToken('API TOKEN')->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'error' => $validate->errors()
            ], 401);
        }
    }

    public function register(Request $request)
    {
        try {
            //code...
            $validate = validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]);

            if ($validate->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validate errors',
                    'error' => $validate->errors()
                ], 401);
            }
            User::create([
                'email' => $request->email,
                'name' => $request->name,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'user created'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'error' => $validate->errors()
            ], 401);
        }
    }

    public function alluser()
    {
        return response()->json([
            'users' => User::all(),
            'message' => true
        ]);
    }

    public function logout(Request $request)
    {

        // Revoke the token that was used to authenticate the current request...
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'logout success'
        ], 200);
    }
}
