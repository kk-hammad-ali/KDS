<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('public.blog.blog');
    }

    public function commonTraffic()
    {
        return view('public.blog.common-traffic');
    }

    public function drivingTest()
    {
        return view('public.blog.driving-test');
    }

    public function tipsBeginner()
    {
        return view('public.blog.tips-for-beginner');
    }
}
