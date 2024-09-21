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
        $courses = Course::all();

        // Pass the courses to the view
        return view('admin.courses.all_courses', compact('courses'));
    }


    public function addCourses(){
        return view('admin.courses.add_courses');
    }

    public function storeCourse(Request $request){
        $validatedData = $request->validate([
            // 'course_name' => 'required|string|max:255',
            'fees' => 'required|numeric',
            'duration_days' => 'required|numeric',
            'duration_minutes' => 'required|numeric',
        ]);

        Course::create([
            // 'name' => $validatedData['course_name'],
            'fees' => $validatedData['fees'],
            'duration_days' => $validatedData['duration_days']. ' Days',
            'duration_minutes' => $validatedData['duration_minutes']. ' Minutes',
        ]);

        return redirect()->route('admin.allCourses')->with('success_courses', 'Course added successfully');
    }


    public function editCourse($id){
        $course = Course::findOrFail($id);

        // Remove the "Days" or "Minutes" suffix for the edit form
        $course->duration_days = str_replace(' Days', '', $course->duration_days);
        $course->duration_minutes = str_replace(' Minutes', '', $course->duration_minutes);

        return view('admin.courses.edit_courses', compact('course'));
    }


    public function updateCourse(Request $request, $id)
    {
        $validatedData = $request->validate([
            'fees' => 'required|numeric',
            'duration_days' => 'required|numeric',
            'duration_minutes' => 'required|numeric',
        ]);

        $course = Course::findOrFail($id);

        $course->update([
            'fees' => $validatedData['fees'],
            'duration_days' => $validatedData['duration_days'] . ' Days',
            'duration_minutes' => $validatedData['duration_minutes'] . ' Minutes',
        ]);



        return redirect()->route('admin.allCourses')->with('successfully_edit', 'Course updated successfully');

    }


    public function deleteCourse($id){
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('admin.allCourses')->with('success_deleted', 'Course deleted successfully');
    }

}
