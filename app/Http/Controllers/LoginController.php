<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentails = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentails)) {
            $user = $request->user();
            $token = $user->createToken($user->email);

            return response()->json([
                'token' => $token->plainTextToken,
                'tokken_type' => 'Bearer',
                'user' => $user
            ], 200);
        }
        return response()->json(['message' => 'Invalid login details'], 401)->header('Content-Type', 'application/json');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out'], 200);
    }
}
