<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class AdminContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->get();
        // Mark all as read
        Contact::where('is_read', false)->update(['is_read' => true]);
        return view('admin.contacts.index', compact('contacts'));
    }
}
