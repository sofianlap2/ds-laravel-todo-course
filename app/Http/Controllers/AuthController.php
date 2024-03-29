<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TodoModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth/register');
    }

    public function indexLogin()
    {
        return view('auth/login');
    }

    public function doLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $todos = TodoModel::where('user_id', Auth::user()->id)->get();
            return view('todo/todo-homepage', compact('todos'));
        } else {
            return redirect()->route('auth.indexLogin')->withErrors([
                'email' => 'Credentials are incorrect'
            ])->onlyInput('email');
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
            return redirect()->route('auth.register')->withErrors($validator);
        }

        $image = $request->file('image_upload');

        if($image != null && !$image->getError() ) {
            $imagePath = $image->store('todo', 'public');
        } else {
            $imagePath = "";
        }

        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'image' => $imagePath
        ]);

        return redirect()->route('auth.indexLogin');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerateToken();
        $request->session()->invalidate();

        return redirect()->route('auth.indexLogin');
    }
}
