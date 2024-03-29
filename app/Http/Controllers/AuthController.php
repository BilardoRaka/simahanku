<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function registration()
    {
        return view('auth.registration');
    }

    public function storeRegistration(CustomerRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $user = User::create([
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => 'customer'
        ]);
        
        if($request->file('logo')){
            $extension  = request()->file('logo')->getClientOriginalExtension();
            $image_name = time() .'.' . $extension;
            $customer['image'] = $request->file('logo')->storePubliclyAs('image', $image_name, 'public');
        }

        $customer['user_id'] = $user->id;
        $customer['company_name'] = $data['company_name'];
        $customer['pic'] = $data['pic'];
        $customer['phone'] = $data['phone'];
        $customer['address'] = $data['address'];

        Customer::create($customer);


        return redirect('/signin')->with('success', 'Anda telah berhasil registrasi, silahkan login.');

    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/signin');
    }
}
