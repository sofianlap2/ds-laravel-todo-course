<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthControllerApi extends Controller
{
    public function doLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;
            return response()->json(['token' => $token]);
        } else {
            return response()->json(['error' => "Credentials incorrect"], 400);

        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:60',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'image_upload' => 'max:5000'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toArray()], 400);
        }

        $image = $request->file('image_upload');

        if($image != null && !$image->getError() ) {
            $imagePath = $image->store('todo', 'public');
        } else {
            $imagePath = "";
        }

        $user= User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'image' => $imagePath
        ]);

        $token = $user->createToken('API Token')->plainTextToken;
        return response()->json(['token' => $token]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json(['message' => 'logout success']);
    }
}
