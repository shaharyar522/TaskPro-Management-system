<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;

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
        $user->status = 1;
        $user->save();

        return redirect()->route('user.pending')->with('success', 'User approved successfully.');
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



    public function blockedIndex()
    {
        $blocked = User::where('blocked', 1)->paginate(5);;

        return view('users_status.block_user', compact('blocked'));
    }
}
