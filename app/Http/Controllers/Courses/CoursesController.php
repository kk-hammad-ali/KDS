<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CarModel;

class CoursesController extends Controller
{
    /**
     * Display a listing of all courses
     */
    public function allCoursesPage()
    {
        // Fetch all courses with car model relationships
        $courses = Course::with('carModel')->paginate(10);
        $carModels = CarModel::all(); // Fetch all car models for dropdowns
        return view('courses.all_courses', compact('courses', 'carModels'));
    }

    /**
     * Show the form for creating a new course
     */
    public function addCourses()
    {
        $carModels = CarModel::all(); // Fetch all car models
        return view('admin.courses.add_courses', compact('carModels'));
    }

    /**
     * Store a newly created course in the database
     */
    public function storeCourse(Request $request)
    {
        $validatedData = $request->validate([
            'car_model_id' => 'required|exists:car_models,id',
            'fees' => 'required|numeric',
            'duration_days' => 'required|integer',
            'duration_minutes' => 'required|integer',
            'course_type' => 'required|in:male,female,both',
        ]);

        Course::create($validatedData);

        return redirect()->route('admin.allCourses')->with('success_courses', 'Course added successfully.');
    }


    /**
     * Show the form for editing a specific course
     */
    public function editCourse($id)
    {
        $course = Course::findOrFail($id); // Fetch the specific course
        $carModels = CarModel::all(); // Fetch all car models for the dropdown
        return view('admin.courses.edit_courses', compact('course', 'carModels'));
    }

    /**
     * Update a specific course in the database
     */
    public function updateCourse(Request $request, $id)
    {
        $validatedData = $request->validate([
            'car_model_id' => 'required|exists:car_models,id',
            'fees' => 'required|numeric',
            'duration_days' => 'required|integer',
            'duration_minutes' => 'required|integer',
            'course_type' => 'required|in:male,female,both',
        ]);

        $course = Course::findOrFail($id);
        $course->update($validatedData);

        return redirect()->route('admin.allCourses')->with('successfully_edit', 'Course updated successfully.');
    }


    /**
     * Delete a specific course from the database
     */
    public function deleteCourse($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('admin.allCourses')->with('success_deleted', 'Course deleted successfully');
    }
}
