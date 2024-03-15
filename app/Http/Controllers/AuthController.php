<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {   
        return view('components.pages.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $remember = $request->has('remember') ? true : false;

        if(Auth::attempt($credentials, $remember)) {
            return redirect()->route('dashboard.index');
        }

        $request->session()->put('fails', 'Invalid credentials please review and try again.');
        return back();
    }

    public function registerView()
    {
        return view('components.pages.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('auth.login')->withInput();
    }

    public function logout(Request $request)
    {
        $route = route('auth.login.view');
    
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect($route);
    }
}
