<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class CertificateController extends Controller
{
    public function index()
    {
        // Fetch the student details of the logged-in user
        $student = Student::where('user_id', Auth::id())->first();

        // Check if the course has ended
        if ($student && $student->course_end_date <= now()) {
            return view('student.my_certificate', compact('student'));
        }

        // If the course hasn't ended, return a flag indicating the certificate is not available
        return view('student.my_certificate')->with('certificateAvailable', false);
    }
}
