<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('orders')->where('is_admin', false)->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function admins()
    {
        $admins = User::where('is_admin', true)->latest()->get();
        return view('admin.users.admins', compact('admins'));
    }
}
