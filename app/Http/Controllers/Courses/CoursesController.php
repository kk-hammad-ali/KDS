<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Car;

class CoursesController extends Controller
{
    public function allCoursesPage()
    {
        // Fetch all courses from the database
        $courses = Course::with('car')->paginate(10);

        $cars = Car::all();
        return view('courses.all_courses', compact('courses', 'cars'));
    }

    public function addCourses()
    {
        $cars = Car::all();
        return view('admin.courses.add_courses', compact('cars'));
    }

    public function storeCourse(Request $request)
    {
        $validatedData = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'fees' => 'required|numeric',
            'duration_days' => 'required|integer',
            'duration_minutes' => 'required|integer',
        ]);

        Course::create([
            'car_id' => $validatedData['car_id'],
            'fees' => $validatedData['fees'],
            'duration_days' => $validatedData['duration_days'],
            'duration_minutes' => $validatedData['duration_minutes'],
        ]);

        return redirect()->route('admin.allCourses')->with('success_courses', 'Course added successfully');
    }

    public function editCourse($id)
    {
        $course = Course::findOrFail($id);
        $cars = Car::all();
        return view('admin.courses.edit_courses', compact('course', 'cars'));
    }

    public function updateCourse(Request $request, $id)
    {
        $validatedData = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'fees' => 'required|numeric',
            'duration_days' => 'required|integer',
            'duration_minutes' => 'required|integer',
        ]);

        $course = Course::findOrFail($id);

        $course->update([
            'car_id' => $validatedData['car_id'],
            'fees' => $validatedData['fees'],
            'duration_days' => $validatedData['duration_days'],
            'duration_minutes' => $validatedData['duration_minutes'],
        ]);

        return redirect()->route('admin.allCourses')->with('successfully_edit', 'Course updated successfully');
    }

    public function deleteCourse($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('admin.allCourses')->with('success_deleted', 'Course deleted successfully');
    }
}
