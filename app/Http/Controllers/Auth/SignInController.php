<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function index()
    {
        return view('auth.sign-in');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect based on role using Spatie's permission system
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('instructor')) {
                return redirect()->route('instructor.dashboard');
            } elseif ($user->hasRole('student')) {
                return redirect()->route('student.dashboard');
            } elseif ($user->hasRole('manager')) {
                return redirect()->route('manager.dashboard');
            } else {
                return redirect('/signin')->withErrors(['role' => 'Unauthorized role.']);
            }
        } else {
            return back()->withErrors([
                'login_error' => 'Invalid username or password. Please try again.',
            ])->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/'); // Redirect to home after logout
    }
}
