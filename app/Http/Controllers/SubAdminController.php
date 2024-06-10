<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:sub_admin']);
    }

    // Display the sub-admin dashboard
    public function index()
    {
        return view('subadmin.dashboard');
    }
}
