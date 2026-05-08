<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'required|string',
            'message' => 'required|string|min:10|max:2000',
        ]);

        Contact::create($validated);

        return redirect()->route('contact')->with('contact_success', true);
    }
}
