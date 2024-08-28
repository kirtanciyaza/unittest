<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate an access token
        $token = $user->createToken('Personal Access Token')->accessToken;

        // return response()->json(['token' => $token], 201);

          return response()->json(['user' => $user,'token' => $token], 201);
    }

    public function login(Request $request)
    {
    // Validate the request
    $validator = Validator::make($request->all(), [
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Check the credentials
    if (!auth()->attempt($request->only('email', 'password'))) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Get the authenticated user
    $user = auth()->user();
    $token = $user->createToken('Personal Access Token')->accessToken;


    return response()->json(['token' => $token], 200);
    }



public function user(Request $request)
{

    $user = auth()->user();

    $token = $request->bearerToken();



    return response()->json([
        'user' => $user,
        'message' => 'Success',
        'token' => $token
    ], 200);
}



}
