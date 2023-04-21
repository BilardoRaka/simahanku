<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signin()
    {
        return view('auth.signin');
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        if(Auth::attempt($data)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->with('peringatan', 'Username/Password yang anda masukkan salah!');

    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/signin');
    }
}
