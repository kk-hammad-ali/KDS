<?php

namespace App\Http\Controllers\Leave;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function all_leaves_instructor()
    {
        // $instructor = Auth::user();


        $leaves = Leave::where('user_id', 1)->get();

        return view('instructor.leaves.all_leaves', compact('leaves'));
    }


    public function addLeavesInstructor(){
        return view('instructor.leaves.apply_leave');
    }


    public function storeLeaves(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'leave_reason' => 'required|string|max:255',
        ]);

        // Create a new leave record
        Leave::create([
            'user_id' => Auth::id(),
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'leave_reason' => $validated['leave_reason'],
            'status' => 'pending', // Default status
        ]);

        // Redirect back with a success message
        return redirect()->route('instructor.allLeaves')->with('success_leave_stored', 'Leave application submitted successfully.');
    }


    public function editLeave(Leave $leave)
    {
        // Ensure the leave belongs to the authenticated user
        if ($leave->user_id !== Auth::id()) {
            return redirect()->route('instructor.allLeaves')->with('error_leaves', 'Unauthorized access.');
        }

        return view('instructor.leaves.edit_leaves', compact('leave'));
    }

    public function updateLeave(Request $request, Leave $leave)
    {
        // Ensure the leave belongs to the authenticated user
        if ($leave->user_id !== Auth::id()) {
            return redirect()->route('instructor.allLeaves')->with('error_leaves', 'Unauthorized access.');
        }

        // Validate the request data
        $validated = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'leave_reason' => 'required|string|max:255',
        ]);

        // Update the leave record
        $leave->update([
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'leave_reason' => $validated['leave_reason'],
            'status' => 'pending',
        ]);

        // Redirect back with a success message
        return redirect()->route('instructor.allLeaves')->with('success_leave_updated', 'Leave application updated successfully.');
    }

    public function destroy(Leave $leave)
    {
        // Ensure the leave belongs to the authenticated user
        if ($leave->user_id !== Auth::id()) {
            return redirect()->route('instructor.allLeaves')->with('error_leaves', 'Unauthorized access.');
        }

        // Delete the leave record
        $leave->delete();

        // Redirect back with a success message
        return redirect()->route('instructor.allLeaves')->with('success_leave_deleted', 'Leave application deleted successfully.');
    }

    public function allLeavePage()
    {
        $leaves = Leave::all();
        return view('admin.leaves.Leaves', compact('leaves'));
    }

    public function updateStatus(Request $request)
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
}
