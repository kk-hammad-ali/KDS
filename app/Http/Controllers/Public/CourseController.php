<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Car;



class CourseController extends Controller
{

    public function index()
    {
        $courses = Course::all();
        $cars = Car::all();
        return view('public.courses.courses');
    }

    public function mehranCourse()
    {
        $courses = Course::all();
        $cars = Car::all();
        return view('public.courses.mehran', compact('courses', 'cars'));
    }

    public function altoCourse()
    {
        $courses = Course::all();
        $cars = Car::all();
        return view('public.courses.alto', compact('courses', 'cars'));
    }

    public function hondaCourse()
    {
        $courses = Course::all();
        $cars = Car::all();
        return view('public.courses.honda', compact('courses', 'cars'));
    }

    public function vitzCourse()
    {
        $courses = Course::all();
        $cars = Car::all();
        return view('public.courses.vitz', compact('courses', 'cars'));
    }

    public function miraCourse()
    {
        $courses = Course::all();
        $cars = Car::all();
        return view('public.courses.mira', compact('courses', 'cars'));
    }

    public function cd70()
    {
        $courses = Course::all();
        $cars = Car::all();
        return view('public.courses.cd70', compact('courses', 'cars'));
    }
}
