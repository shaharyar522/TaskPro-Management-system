<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ApproveUsers extends Controller
{
    public function index()
    {
        $aprove_users = User::where('status', 1)
                            ->where('blocked', 0)
                            ->get();

        return view('approved_users.index', compact('aprove_users'));
    }

    public function block($id)
    {
        $user = User::findOrFail($id);
        $user->blocked = 1;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User has been blocked successfully.'
        ]);
    }
}
