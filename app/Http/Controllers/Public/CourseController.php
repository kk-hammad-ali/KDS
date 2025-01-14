<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Car;
use App\Models\CarModel;

class CourseController extends Controller
{

    public function index()
    {
        $courses = Course::all();
        $carModels = CarModel::all();
        return view('public.courses.courses');
    }

    public function mehranCourse()
    {
        $courses = Course::whereHas('carModel', function ($query) {
            $query->where('name', 'LIKE', '%Mehran%');
        })->get();

        $carModels = CarModel::all();
        return view('public.courses.mehran', compact('courses', 'carModels'));
    }


    public function altoCourse()
    {
        $courses = Course::whereHas('carModel', function ($query) {
            $query->where('name', 'LIKE', '%alto%');
        })->get();

        $carModels = CarModel::all();
        return view('public.courses.alto', compact('courses', 'carModels'));
    }

    public function hondaCourse()
    {
        $courses = Course::whereHas('carModel', function ($query) {
            $query->where('name', 'LIKE', '%honda%');
        })->get();

        $carModels = CarModel::all();
        return view('public.courses.honda', compact('courses', 'carModels'));
    }

    public function vitzCourse()
    {
        $courses = Course::whereHas('carModel', function ($query) {
            $query->where('name', 'LIKE', '%vitz%');
        })->get();

        $carModels = CarModel::all();
        return view('public.courses.vitz', compact('courses', 'carModels'));
    }

    public function miraCourse()
    {
        $courses = Course::whereHas('carModel', function ($query) {
            $query->where('name', 'LIKE', '%mira%');
        })->get();

        $carModels = CarModel::all();
        return view('public.courses.mira', compact('courses', 'carModels'));
    }

    public function cd70()
    {
        $courses = Course::whereHas('carModel', function ($query) {
            $query->where('name', 'LIKE', '%bike%');
        })->get();

        $carModels = CarModel::all();
        return view('public.courses.cd70', compact('courses', 'carModels'));
    }

    public function swiftCourse()
    {
        $courses = Course::whereHas('carModel', function ($query) {
            $query->where('name', 'LIKE', '%swift%');
        })->get();

        $carModels = CarModel::all();
        return view('public.courses.swift', compact('courses', 'carModels'));
    }

}
