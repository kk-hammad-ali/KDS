<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instructor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class InstructorController extends Controller
{
    public function index()
    {
        return view('instructor.dashboard');
    }

    public function adminAllInstructors()
    {
        $instructors = Instructor::with('user')->get();

        return view('admin.instructors.all_instructors', compact('instructors'));
    }


    public function adminAddInstructor(){
        return view('admin.instructors.add_instructor');
    }

    public function adminStoreInstructor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'experience' => 'nullable|string|max:255',
            'phone_number' => 'required|string',
            'address' => 'required|string|max:255',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'gender' => 'required|in:male,female',
            'license_number' => 'required|string|max:255',
            'id_card_number' => 'required|string|max:255',
            'license_city' => 'required|string|max:255',
            'license_start_date' => 'required|date',
            'license_end_date' => 'required|date',
        ]);

        // Create the user first
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => 1,
        ]);

        // Handle the file upload if a picture is provided
        $picturePath = null;
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $picturePath = $picture->store('instructors', 'public');
            $picturePath = str_replace('public', '', $picturePath);
        }

        // Create the instructor
        Instructor::create([
            'user_id' => $user->id,
            'experience' => $request->experience,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'picture' => $picturePath,
            'gender' => $request->gender,
            'license_number' => $request->license_number,
            'id_card_number' => $request->id_card_number,
            'license_city' => $request->license_city,
            'license_start_date' => $request->license_start_date,
            'license_end_date' => $request->license_end_date,
        ]);


        return redirect()->route('admin.allInstructors')->with('success_instructor', 'Instructor added successfully.');
    }



    public function adminEditInstructor($id)
    {
        $instructor = Instructor::findOrFail($id);

        // Pass the instructor data to the view
        return view('admin.instructors.edit_instructor', compact('instructor'));
    }

    public function adminUpdateInstructor(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'experience' => 'nullable|string|max:255',
            'phone_number' => 'required|string',
            'address' => 'required|string|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'gender' => 'required|in:male,female',
            'license_number' => 'required|string|max:255',
            'id_card_number' => 'required|string|max:255',
            'license_city' => 'required|string|max:255',
            'license_start_date' => 'required|date',
            'license_end_date' => 'required|date',
        ]);

        $instructor = Instructor::findOrFail($id);

        // Update the user information
        $user = $instructor->user;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->save();

        // Handle the file upload if a new picture is provided
        if ($request->hasFile('picture')) {
            // Delete the old picture if exists
            if ($instructor->picture) {
                Storage::disk('public')->delete('instructors/' . $instructor->picture);
            }

            $picture = $request->file('picture');
            $picturePath = $picture->store('instructors', 'public');
            $picturePath = str_replace('public', '', $picturePath);
        } else {
            $picturePath = $instructor->picture; // Keep the old picture
        }

        // Update the instructor data
        $instructor->update([
            'experience' => $request->experience,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'picture' => $picturePath,
            'gender' => $request->gender,
            'license_number' => $request->license_number,
            'id_card_number' => $request->id_card_number,
            'license_city' => $request->license_city,
            'license_start_date' => $request->license_start_date,
            'license_end_date' => $request->license_end_date,
        ]);

        return redirect()->route('admin.allInstructors')->with('success_updated_instructor', 'Instructor updated successfully.');
    }

    public function adminDestroyInstructor($id)
    {
        // Find the instructor by ID
        $instructor = Instructor::findOrFail($id);

        // Check if the instructor has a picture and delete it if necessary
        if ($instructor->picture) {
            Storage::disk('public')->delete('instructors/' . $instructor->picture);
        }

        // Delete the instructor
        $instructor->delete();

        return redirect()->route('admin.allInstructors')->with('success_deleted_instructor', 'Instructor deleted successfully.');
    }
}
