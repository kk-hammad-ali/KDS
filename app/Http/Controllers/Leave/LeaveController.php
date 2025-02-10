<?php

namespace App\Http\Controllers\Leave;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\User;
use App\Models\Student;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use App\Notifications\LeaveSubmittedNotification;
use App\Notifications\LeaveStatusUpdatedNotification;

class LeaveController extends Controller
{
    public function adminallLeaves()
    {
        $leaves = Leave::paginate(10);
        return view('leaves.leaves', compact('leaves'));
    }

    public function adminupdateLeaveStatus(Request $request)
    {
        $request->validate([
            'leave_id' => 'required|exists:leaves,id',
            'status' => 'required|in:approved,rejected',
        ]);

        $leave = Leave::findOrFail($request->leave_id);
        $leave->update(['status' => $request->status]);

        // Notify the user about the leave status update
        if ($leave->student_id) {
            $leave->student->user->notify(new LeaveStatusUpdatedNotification($leave));
        } elseif ($leave->employee_id) {
            $leave->employee->user->notify(new LeaveStatusUpdatedNotification($leave));
        }

        // Set the success message based on the status
        $messageKey = $request->status == 'approved'
            ? 'success_approved'
            : 'success_rejected';

        return redirect()->route('admin.allLeaves')->with($messageKey, 'Leave request ' . ($request->status == 'approved' ? 'approved' : 'rejected') . ' successfully.');
    }

    // Instructor Leave Functions
    public function all_leaves_instructor()
    {
        $employee = Employee::where('user_id', Auth::id())->first();
        if (!$employee) {
            return redirect()->route('home')->with('error', 'You are not an instructor.');
        }

        $leaves = Leave::where('employee_id', $employee->id)->paginate(10);
        return view('leaves.instructor.all_leaves', compact('leaves'));
    }

    public function addLeavesInstructor(){
        return view('leaves.instructor.apply_leave');
    }

    public function storeLeavesInstructor(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'leave_reason' => 'required|string|max:255',
        ]);

        $employee = Employee::where('user_id', Auth::id())->first();
        if (!$employee) {
            return redirect()->route('home')->with('error', 'You are not an instructor.');
        }

        $leave = Leave::create([
            'employee_id' => $employee->id,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'leave_reason' => $validated['leave_reason'],
            'status' => 'pending',
        ]);

        // Notify the admin
        $adminUser = User::whereHas('roles', function($query) {
            $query->where('name', 'admin');
        })->first();

        if ($adminUser) {
            $adminUser->notify(new LeaveSubmittedNotification($leave));
        }

        return redirect()->route('instructor.allLeaves')->with('success_leave_stored', 'Leave application submitted successfully.');
    }

    public function editLeaveInstructor(Leave $leave)
    {
        $employee = Employee::where('user_id', Auth::id())->first();
        if (!$employee || $leave->employee_id !== $employee->id) {
            return redirect()->route('instructor.allLeaves')->with('error_leaves', 'Unauthorized access.');
        }

        return view('leaves.instructor.edit_leaves', compact('leave'));
    }

    public function updateLeaveInstructor(Request $request, Leave $leave)
    {
        $employee = Employee::where('user_id', Auth::id())->first();
        if (!$employee || $leave->employee_id !== $employee->id) {
            return redirect()->route('instructor.allLeaves')->with('error_leaves', 'Unauthorized access.');
        }

        $validated = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'leave_reason' => 'required|string|max:255',
        ]);

        $leave->update([
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'leave_reason' => $validated['leave_reason'],
            'status' => 'pending',
        ]);

        return redirect()->route('instructor.allLeaves')->with('success_leave_updated', 'Leave application updated successfully.');
    }

    public function destroyInstructorLeave(Leave $leave)
    {
        $employee = Employee::where('user_id', Auth::id())->first();
        if (!$employee || $leave->employee_id !== $employee->id) {
            return redirect()->route('instructor.allLeaves')->with('error_leaves', 'Unauthorized access.');
        }

        $leave->delete();

        return redirect()->route('instructor.allLeaves')->with('success_leave_deleted', 'Leave application deleted successfully.');
    }

    // Student Leave Functions
    public function all_leaves_student()
    {
        $student = Student::where('user_id', Auth::id())->first();
        if (!$student) {
            return redirect()->route('home')->with('error', 'You are not a student.');
        }

        $leaves = Leave::where('student_id', $student->id)->get();
        return view('student.leaves.all_leaves', compact('leaves'));
    }

    public function addLeavesStudent(){
        return view('student.leaves.apply_leave');
    }

    public function storeLeavesStudent(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'leave_reason' => 'required|string|max:255',
        ]);

        $student = Student::where('user_id', Auth::id())->first();
        if (!$student) {
            return redirect()->route('home')->with('error', 'You are not a student.');
        }

        $leave = Leave::create([
            'student_id' => $student->id,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'leave_reason' => $validated['leave_reason'],
            'status' => 'pending',
        ]);

        $adminUser = User::whereHas('roles', function($query) {
            $query->where('name', 'admin');
        })->first();

        if ($adminUser) {
            $adminUser->notify(new LeaveSubmittedNotification($leave));
        }

        return redirect()->route('student.dashboard')->with('success_leave_stored', 'Leave application submitted successfully.');
    }

    public function editLeaveStudent(Leave $leave)
    {
        $student = Student::where('user_id', Auth::id())->first();
        if (!$student || $leave->student_id !== $student->id) {
            return redirect()->route('student.allLeaves')->with('error_leaves', 'Unauthorized access.');
        }

        return view('student.leaves.edit_leaves', compact('leave'));
    }

    public function updateLeaveStudent(Request $request, Leave $leave)
    {
        $student = Student::where('user_id', Auth::id())->first();
        if (!$student || $leave->student_id !== $student->id) {
            return redirect()->route('student.allLeaves')->with('error_leaves', 'Unauthorized access.');
        }

        $validated = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'leave_reason' => 'required|string|max:255',
        ]);

        $leave->update([
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'leave_reason' => $validated['leave_reason'],
            'status' => 'pending',
        ]);

        return redirect()->route('student.dashboard')->with('success_leave_updated', 'Leave application updated successfully.');
    }

    public function destroyStudentLeave(Leave $leave)
    {
        $student = Student::where('user_id', Auth::id())->first();
        if (!$student || $leave->student_id !== $student->id) {
            return redirect()->route('student.allLeaves')->with('error_leaves', 'Unauthorized access.');
        }

        $leave->delete();

        return redirect()->route('student.dashboard')->with('success_leave_deleted', 'Leave application deleted successfully.');
    }
}
