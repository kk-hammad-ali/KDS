<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\hash;
use App\Models\User;

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
                    return redirect('/sign-in')->withErrors(['role' => 'Unauthorized role.']);
            }
        } else {
            // Return back to the sign-in page with an error
            return back()->withErrors([
                'login_error' => 'Invalid username or password. Please try again.',
            ])->withInput();
        }
    }

    public function adminLogout(){
        session()->forget('admin_id');
        session()->forget('user');

        return redirect('/');
    }

    public function instructorLogout(){
        session()->forget('instructor_id');
        session()->forget('user');
        return redirect('/');
    }

    public function studentLogout(){
        session()->forget('student_id');
        session()->forget('user');
        return redirect('/');
    }
}
