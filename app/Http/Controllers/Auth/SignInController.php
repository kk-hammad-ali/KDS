<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

            switch ($user->role) {
                case '0':
                    // Admin
                    session()->put('admin_id', $user->id);
                    session()->put('user', $user);
                    return redirect('/admin/dashboard');

                case '1':
                    // Instructor
                    session()->put('instructor_id', $user->id);
                    session()->put('user', $user);
                    return redirect('/instructor/dashboard');

                case '2':
                    // Student
                    session()->put('student_id', $user->id);
                    session()->put('user', $user);
                    return redirect('/student/dashboard');

                default:
                    // If the role is not recognized
                    return redirect('/login')->withErrors(['role' => 'Unauthorized role.']);
            }
        } else {
            return redirect('/sign-in')->withErrors(['old_password' => 'Wrong name or password.']);
        }
    }
}
