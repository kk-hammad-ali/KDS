<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use PDF;

class CertificateController extends Controller
{

    public function downloadCertificate()
    {
        // Get the logged-in student
        $student = Student::where('user_id', auth()->id())->first();

        // Ensure the student has completed the course
        if ($student && $student->course_end_date <= now()) {
            // Convert the image to base64
            $path = public_path('public/images/logo.png');  // Adjust the path if necessary
            if (file_exists($path)) {
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            } else {
                $base64 = null;  // Fallback if image is not found
            }

            // Generate the PDF and pass the base64 string to the view
            $pdf = PDF::loadView('student.my_certificate', compact('student', 'base64'))
                ->setPaper('a4', 'landscape')  // Set to A4 size with portrait orientation
                ->setOptions(['defaultFont' => 'sans-serif']);

            // Download the PDF with the student's name
            return $pdf->download($student->user->name . '_certificate.pdf');
        }

        return redirect()->back()->with('error', 'Certificate is only available after course completion.');
    }


}
