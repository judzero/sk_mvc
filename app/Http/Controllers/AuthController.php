<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //show home
    public function home()
    {
        return view('pages.home');
    }
    //show login
    public function showLogin()
    {
        return view('pages.login');
    }
    //show register
    public function showRegister()
    {
        return view('pages.register');
    }
    //show dashboard
    public function showDashboard()
    {
        return view('pages.dashboard');
    }

    //Register user
    public function postRegister(Request $request)
    {
        //validate
        $request->validate([

            'name' => 'required|string|max:255',
            'email' => 'required|email|max:155|unique:users',
            'password' => 'required|min:8|max:21'
        ]);

        //user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Account created successfully');

        //login
        Auth::login($user);

        return back()->with('success', 'Login Successful!');
    }

    public function postLogin(Request $request)
    {
        //validate
        $details = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //login
        if(Auth::attempt($details))
        {
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid Login Details'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return back();
    }
}
