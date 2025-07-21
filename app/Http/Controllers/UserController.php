<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class UserController extends Controller
{
    // jb user ka staut or block 0 hnga tb
    public function pendingIndex()
    {
        $pendings = User::where('status', 0)
            ->where('blocked', 0)
            ->whereHas('roles', function ($query) {
                $query->where('name', 'user');
            })->paginate(5);

        return view('users_status.pending_user', compact('pendings'));
    }

    // Show user details (AJAX) jo model use ky ahain 
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    //  jb user ka status 1 or block 0 hnga tb
    public function approvedIndex()
    {
        $approved = User::where('status', 1)
            ->where('blocked', 0)
            ->whereHas('roles', function ($query) {
                $query->where('name', 'user');
            })->paginate(5);

        return view('users_status.approve_user', compact('approved'));
    }
    // Approve user (set status = 1)
    public function approve(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $user->project_name = $request->project_name;
        $user->status = $request->status;
        $user->save();

        $message = ($request->status == 0)
            ? 'User status is  pending .'
            : 'User approved successfully.';

        return redirect()->route('user.pending')->with('success', $message);
    }

    // Block a user (set blocked = 1)
    public function block($id)
    {
        $user = User::findOrFail($id);

        // Ensure only normal users are blocked
        if ($user->hasRole('user')) {
            $user->blocked = 1;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User has been blocked successfully.',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Cannot block this user.',
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'copy_id' => 'nullable|string|max:255',
            'project_name' => 'nullable|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'registration_date' => 'nullable|date',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->copy_id = $request->copy_id;
        $user->project_name = $request->project_name;
        $user->email = $request->email;
        $user->registration_date = $request->registration_date;
        $user->save();

        return redirect()->route('approved.users')->with('success', 'User Approved updated successfully.');
    }






    public function blockedIndex()
    {
        $blocked = User::where('blocked', 1)->paginate(5);;

        return view('users_status.block_user', compact('blocked'));
    }

    public function unblock($id)
    {
        $user = User::findOrFail($id);
        $user->blocked = 0;
        $user->save();

        return response()->json(['message' => 'User unblocked successfully']);
    }

    public function Blockupdate(Request $request, $id)
    {
        // Validation...
        $request->validate([
            'name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'copy_id' => 'nullable|string|max:255',
            'project_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'registration_date' => 'nullable|date',
        ]);

        // Update logic
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->copy_id = $request->copy_id;
        $user->project_name = $request->project_name;
        $user->email = $request->email;
        $user->registration_date = $request->registration_date;
        $user->save();

        // ✅ REDIRECTS CORRECTLY
        return redirect()->route('user.blocked')->with('success', 'User Block updated successfully.');
    }


    public function frontier()
    {
        return view('user.dashboard');
    }

    public function cci()
    {
        return view('user.dashboardtwo');
    }
}
