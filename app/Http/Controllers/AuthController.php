<?php

namespace App\Http\Controllers;

use App\Jobs\CustomerJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\SendMailable;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function loginForm() {
        return view('auth.login');
    }

    public function registerForm() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|confirmed|string|min:6',
        ]);

        $token = Str::random(24);

        $user = User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => bcrypt($request->password),
            'remember_token'    => $token
        ]);

        $defaultRole = Role::where('name', 'client')->first();
        if ($defaultRole) {
            $user->assignRole($defaultRole);
        }

        CustomerJob::dispatch(($user));

        return redirect('/')->with('message', 'Verification link sent.');
    }

    public function verification(User $user, $token) {
        if ($user->remember_token !== $token) {
            return redirect('/')->with('error', 'Error');
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect('/')->with('message', 'Account verified successfully.');
    }

    public function login (Request $request) {
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || $user->email_verified_at == null) {
            return redirect('/')->with('error', 'Invalid credentials. Please try again later.');
        }

        $login = auth()->attempt([
            'email'     => $request->email,
            'password'  => $request->password
        ]);

        if (!$login) {
            return back()->with('error', 'Invalid credentials. Please try again later.');
        }

        return redirect('/dashboard');
    }

    public function logout(Request $request) {
        auth()->logout();

        return redirect('/')->with('message', 'User Logged out');
    }
}
