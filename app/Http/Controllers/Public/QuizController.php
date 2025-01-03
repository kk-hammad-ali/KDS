<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizController extends Controller
{

    public function index()
    {
        return view('public.signals.signal-test');
    }

    public function indexEnglish()
    {
        $path = public_path('questions/english_questions.json');

        // Check if the file exists
        if (file_exists($path)) {
            $englishQuestions = json_decode(file_get_contents($path), true);
            return view('public.signals.english-signal-test', compact('englishQuestions'));
        } else {
            // Return an error response if the file does not exist
            return response()->json(['error' => 'English questions file not found'], 404);
        }
    }

    public function indexUrdu()
    {
        $path = public_path('questions/urdu_questions.json');

        // Check if the file exists
        if (file_exists($path)) {
            $urduQuestions = json_decode(file_get_contents($path), true);
            return view('public.signals.urdu-signal-test', compact('urduQuestions'));
        } else {
            // Return an error response if the file does not exist
            return response()->json(['error' => 'Urdu questions file not found'], 404);
        }
    }
}


