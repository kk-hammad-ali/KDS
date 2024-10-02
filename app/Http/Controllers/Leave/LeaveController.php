<?php

namespace App\Http\Controllers\Leave;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    // Admin Leave Functions (Handle both student and instructor leave requests)
    public function adminallLeaves()
    {
        $leaves = Leave::all(); // Fetch all leave requests for both students and instructors
        return view('admin.leaves.Leaves', compact('leaves'));
    }

    public function adminupdateLeaveStatus(Request $request)
    {
        $request->validate([
            'leave_id' => 'required|exists:leaves,id',
            'status' => 'required|in:approved,rejected',
        ]);

        $leave = Leave::findOrFail($request->leave_id);
        $leave->update(['status' => $request->status]);

        // Set the success message based on the status
        $messageKey = $request->status == 'approved'
            ? 'success_approved'
            : 'success_rejected';

        return redirect()->route('admin.allLeaves')->with($messageKey, 'Leave request ' . ($request->status == 'approved' ? 'approved' : 'rejected') . ' successfully.');
    }

    // Instructor Leave Functions
    public function all_leaves_instructor()
    {
        $leaves = Leave::where('user_id', Auth::id())->get();
        return view('instructor.leaves.all_leaves', compact('leaves'));
    }

    public function addLeavesInstructor(){
        return view('instructor.leaves.apply_leave');
    }

    public function storeLeavesInstructor(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'leave_reason' => 'required|string|max:255',
        ]);

        Leave::create([
            'user_id' => Auth::id(),
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'leave_reason' => $validated['leave_reason'],
            'status' => 'pending',
        ]);

        return redirect()->route('instructor.allLeaves')->with('success_leave_stored', 'Leave application submitted successfully.');
    }

    public function editLeaveInstructor(Leave $leave)
    {
        if ($leave->user_id !== Auth::id()) {
            return redirect()->route('instructor.allLeaves')->with('error_leaves', 'Unauthorized access.');
        }

        return view('instructor.leaves.edit_leaves', compact('leave'));
    }

    public function updateLeaveInstructor(Request $request, Leave $leave)
    {
        if ($leave->user_id !== Auth::id()) {
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
        if ($leave->user_id !== Auth::id()) {
            return redirect()->route('instructor.allLeaves')->with('error_leaves', 'Unauthorized access.');
        }

        $leave->delete();

        return redirect()->route('instructor.allLeaves')->with('success_leave_deleted', 'Leave application deleted successfully.');
    }

    // Student Leave Functions (Duplicated for students)
    public function all_leaves_student()
    {
        $leaves = Leave::where('user_id', Auth::id())->get();
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

        Leave::create([
            'user_id' => Auth::id(),
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'leave_reason' => $validated['leave_reason'],
            'status' => 'pending',
        ]);

        return redirect()->route('student.allLeaves')->with('success_leave_stored', 'Leave application submitted successfully.');
    }

    public function editLeaveStudent(Leave $leave)
    {
        if ($leave->user_id !== Auth::id()) {
            return redirect()->route('student.allLeaves')->with('error_leaves', 'Unauthorized access.');
        }

        return view('student.leaves.edit_leaves', compact('leave'));
    }

    public function updateLeaveStudent(Request $request, Leave $leave)
    {
        if ($leave->user_id !== Auth::id()) {
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

        return redirect()->route('student.allLeaves')->with('success_leave_updated', 'Leave application updated successfully.');
    }

    public function destroyStudentLeave(Leave $leave)
    {
        if ($leave->user_id !== Auth::id()) {
            return redirect()->route('student.allLeaves')->with('error_leaves', 'Unauthorized access.');
        }

        $leave->delete();

        return redirect()->route('student.allLeaves')->with('success_leave_deleted', 'Leave application deleted successfully.');
    }
}
