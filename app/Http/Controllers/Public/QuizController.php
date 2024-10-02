<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        // If the request is POST, process the quiz submission
        if ($request->isMethod('post')) {
            // Hard-coded correct answers for the quiz
            $answers = [
                'q1' => '60',
                'q2' => 'Always',
                'q3' => 'Stop',
                'q4' => 'At crosswalks',
                'q5' => 'Prepare to stop',
                'q6' => '15 meters',
                'q7' => 'Pull over and stop',
                'q8' => 'Slow down, look, and listen',
                'q9' => 'You may change lanes',
                'q10' => 'Steer into the skid',
            ];

            $score = 0;

            // Check the answers and calculate the score
            foreach ($answers as $key => $correctAnswer) {
                if ($request->input($key) == $correctAnswer) {
                    $score++;
                }
            }

            // Redirect back to the quiz page with the score in the session
            return redirect()->route('public.quiz')->with('score', $score);
        }

        // If the request is GET, simply show the quiz form
        return view('public.quiz');
    }
}
