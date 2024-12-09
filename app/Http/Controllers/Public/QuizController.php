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
        $englishQuestions = json_decode(file_get_contents(storage_path('app/public/english_questions.json')), true);
        return view('public.signals.english-signal-test', compact('englishQuestions'));
    }

    public function indexUrdu()
    {
        $urduQuestions = json_decode(file_get_contents(storage_path('app/public/urdu_questions.json')), true);
        return view('public.signals.urdu-signal-test', compact('urduQuestions'));
    }
}


