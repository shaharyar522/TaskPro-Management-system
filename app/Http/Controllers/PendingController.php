<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;

class PendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendings = User::where('status', 0)
            ->where('blocked', 0)
            ->get();

        return view('pending_users.index', compact('pendings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
    return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
 public function update(Request $request, $id)
{
    $user = User::findOrFail($id);
    $user->status = $request->status;
    $user->save();

    return redirect()->route('user.pending')->with('success', 'User status updated successfully.');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
