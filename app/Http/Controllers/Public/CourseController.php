<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return view('public.courses.courses');
    }

    public function mehranCourse()
    {
        return view('public.courses.mehran');
    }

    public function altoCourse()
    {
        return view('public.courses.alto');
    }

    public function hondaCourse()
    {
        return view('public.courses.honda');
    }

    public function vitzCourse()
    {
        return view('public.courses.vitz');
    }

    public function miraCourse()
    {
        return view('public.courses.mira');
    }

    public function cd70()
    {
        return view('public.courses.cd70');
    }
}
