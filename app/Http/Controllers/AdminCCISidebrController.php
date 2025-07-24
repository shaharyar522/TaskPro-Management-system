<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminCCISidebrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $frontiers = User::where('project_name', 'Frontier')->paginate(10);
        $showSearch = false; // Default: no search bar

        return view('admin_sidebar.frontier_user', compact('frontiers', 'showSearch'));
    }
    public function search(Request $request)
    {
        $query = User::where('project_name', 'Frontier');

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $frontiers = $query->paginate(10);
        $showSearch = true; // Show search bar only when search happens

        return view('admin_sidebar.frontier_user', compact('frontiers', 'showSearch'))
            ->with('start_date', $request->start_date)
            ->with('end_date', $request->end_date);
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
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
