<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('public.contact.contact_us');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'message' => 'required|string|max:500',
        ]);

        // Store the contact form data in the database
        Contact::create($request->all());

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

    public function adminallContact()
    {
        $contacts = Contact::paginate(10);
        return view('public.contact.admin_contact_all', compact('contacts'));
    }
}
