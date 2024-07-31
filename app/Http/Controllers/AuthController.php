<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  public function login(LoginRequest $request)
  {
    $validated = $request->validated();
    $user = User::firstWhere('email', $validated['email']);

    if (!$user || !Hash::check($validated['password'], $user->password)) {
      return response()->json([
        'status' => false,
        'messages' => 'Incorrect credentials.'
      ], 401);
    }

    $token = $user->createToken($user->name . '_auth_token')->plainTextToken;
    return (new UserResource($user))->additional([
      'user_token' => $token
    ]);
  }

  public function logout(Request $request)
  {
    Auth::user()->tokens()->delete();
    return response()->json([
      'message' => 'Logout successfull'
    ]);
  }
}
