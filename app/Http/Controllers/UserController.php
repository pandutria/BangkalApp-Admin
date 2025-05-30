<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    public function register(Request $request) {
        try {
            // $request->validate([
            //     'role' => 'required|string',
            //     'fullname' => 'required|string',
            //     'username' => 'required|string|unique:users',
            //     'password' => 'required|string',
            //     'image_url' => 'string'
            // ]);

            $user = new User();
            $user->role = $request->role;
            $user->fullname = $request->fullname;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->image_url = null;
            $user->save();

            // $token = $user->createToken('access_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                // 'token' => $token,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function login(Request $request) {
        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }

        $token = $user->createToken('access_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function logout(Request $request) {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        $token->delete();

        return response()->json([
            'message' => 'Logout successfully'
        ], 200);
    }

    public function me() {
        $user = Auth::user();
        return response()->json($user);
    }
}
