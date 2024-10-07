<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CoursesController extends Controller
{
    public function allCoursesPage()
    {
        // Fetch all courses from the database
        $courses = Course::paginate(10);

        // Pass the courses to the view
        return view('courses.all_courses', compact('courses'));
    }

    public function addCourses()
    {
        return view('admin.courses.add_courses');
    }

    public function storeCourse(Request $request)
    {
        $validatedData = $request->validate([
            'fees' => 'required|numeric',
            'duration_days' => 'required|integer',
            'duration_minutes' => 'required|integer',
        ]);

        Course::create([
            'fees' => $validatedData['fees'],
            'duration_days' => $validatedData['duration_days'],
            'duration_minutes' => $validatedData['duration_minutes'],
        ]);

        return redirect()->route('admin.allCourses')->with('success_courses', 'Course added successfully');
    }

    public function editCourse($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.courses.edit_courses', compact('course'));
    }

    public function updateCourse(Request $request, $id)
    {
        $validatedData = $request->validate([
            'fees' => 'required|numeric',
            'duration_days' => 'required|integer',
            'duration_minutes' => 'required|integer',
        ]);

        $course = Course::findOrFail($id);

        $course->update([
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
