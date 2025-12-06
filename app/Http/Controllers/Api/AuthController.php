<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Auth\CreateUserRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
  public function register(CreateUserRequest $request)
  {
    $validatedData = $request->validated();
    $user = User::create([
      'name' => $validatedData['name'],
      'email' => $validatedData['email'],
      'password' => Hash::make($validatedData['password']),
      'userable_id'=> $validatedData['userable_id'],
      'userable_type'=> $validatedData['userable_type'],
    ]);
    return response()->json(['user' => $user]);
  }

  public function login(LoginRequest $request)
  {
    $validatedData = $request->validated();

    $user = User::where('email', $validatedData['email'])->first();
    if (!$user || !Hash::check($validatedData['password'], $user->password)) {
      return response()->json([
        'message' => 'Invalid email or password',
      ], 401);
    }
    $user->tokens()->delete();
    $token = $user->createToken('auth_token')->plainTextToken;
    return response()->json(["token" => $token]);
  }

  public function me()
  {
    return response()->json([
      'user' => auth()->user(),
    ], 200);
  }
}
