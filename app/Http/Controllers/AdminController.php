<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    // Display the admin dashboard and list of users
    public function index()
    {
        $users = User::all();
        $slot = 'this is a slot issue';
        return view('admin.manage_users', compact('users', 'slot'));
    }

    // Update the role of a user
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|exists:roles,name'
        ]);

        $user = User::findOrFail($id);
        $user->syncRoles($request->role);

        return redirect()->back()->with('success', 'User role updated successfully.');
    }
    public function manageUsers()
    {
        $users = User::all();

        return view('admin.manage_users',  compact('users'));
    }
    // In your controller
public function showDashboard() {
    $slot = 'This is the content of the slot';
    return view('admin.dashboard', compact('slot'));
}

}
