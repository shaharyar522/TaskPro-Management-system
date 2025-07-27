<?php

namespace App\Http\Controllers;

use App\Exports\AdminUserFrontierExport;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserFrontier;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use App\Mail\ExcelEmail;

class AdminFrontierSidebrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch all users for the dropdown
        $users = User::where('project_name', 'Frontier')->orderBy('name')->get();

        // Fetch UserFrontier records with user data
        $query = UserFrontier::with('user');

        // Date filtering (based on UserFrontier created_at)
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Get all records
        $frontiers = $query->orderBy('created_at', 'desc')->paginate(10);

        // Return view (All Users selected by default)
        return view('admin_sidebar.frontier_user_records', [
            'frontiers' => $frontiers,
            'users' => $users,
            'user' => null // No specific user selected
        ]);
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
    public function show(Request $request, $id)
    {
        $user = User::where('id', $id)
            ->where('project_name', 'Frontier')
            ->firstOrFail();

        $users = User::where('project_name', 'Frontier')->orderBy('name')->get();

        // Apply date filtering for this user's records
        $query = UserFrontier::where('user_id', $id);

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $frontiers = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin_sidebar.frontier_user_records', compact('user', 'users', 'frontiers'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $userdata = UserFrontier::findOrFail($id);
        return view('admin_sidebar.edit_frontier_user_records', compact('userdata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'created_at' => 'nullable|date',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'corp_id' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'billing_TN' => 'nullable|string|max:255',
            'order_number' => 'nullable|string|max:255',
            'install_T_T_Soc_TTC' => 'nullable|string|max:255',
            'ont_Ntd' => 'nullable|string|max:255',
            'comp_or_refer' => 'nullable|string|max:255',
            'billing_code' => 'nullable|string|max:255',
            'qty' => 'nullable|numeric|nullable',
            'description' => 'nullable|string|max:255',
            'rate' => 'nullable|numeric',
            'total_billed' => 'nullable|numeric',
            'aerial_buried' => 'nullable|string|max:255',
            'fiber' => 'nullable|string|max:255',
            'closeout_notes' => 'nullable|string|max:255',
            'in' => 'nullable|string|max:255',
            'out' => 'nullable|string|max:255',
            'hours' => 'nullable|numeric',
        ]);
        $billingCodes = billingCodes();
        $billingCode = $request->billing_code;

        $userData = UserFrontier::findOrFail($id);

        // ✅ Store using $request->all() or specific fields
        $userData->update([
            'corp_id' => $request->corp_id,
            'address' => $request->address,
            'billing_TN' => $request->billing_TN,
            'order_number' => $request->order_number,
            'install_T_T_Soc_TTC' => $request->install_T_T_Soc_TTC,
            'ont_Ntd' => $request->ont_Ntd,
            'comp_or_refer' => $request->comp_or_refer,
            'billing_code' => $request->billing_code,
            'qty' => $request->qty,
            'description' => $request->description,
            'rate' => $request->rate,
            'total_billed' => $request->total_billed,
            'aerial_buried' => $request->aerial_buried,
            'fiber' => $request->fiber,
            'closeout_notes' => $request->closeout_notes,
            'in' => $request->in,
            'out' => $request->out,
            'hours' => $request->hours,
            'created_at' => $request->created_at ?? $userData->created_at,
        ]);

        if ($userData->user) {
            $userData->user->update([
                'name' => $request->first_name,
                'last_name' => $request->last_name,
            ]);
        }




        return redirect()
            ->route('frontier.show', $userData->user_id)
            ->with('success', 'User data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $frontierData = UserFrontier::findOrFail($id);
        $userId = $frontierData->user_id; // Save user_id for redirect

        // Delete the record
        $frontierData->delete();

        // Redirect back to the show page with success message
        return redirect()
            ->route('user.frontier', $userId)
            ->with('success', 'Record deleted successfully.');
    }

    public function exportPDF()
    {
        $query = UserFrontier::with('user'); // include user relation

        if (request()->has('user_id') && request()->user_id != '') {
            $query->where('user_id', request()->user_id);
        }

        if (request()->has('start_date') && request()->start_date != '') {
            $query->whereDate('created_at', '>=', request()->start_date);
        }

        if (request()->has('end_date') && request()->end_date != '') {
            $query->whereDate('created_at', '<=', request()->end_date);
        }

        $adminfrontire = $query->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin_sidebar.pdf.admin_frontier_pdf', compact('adminfrontire'))
            ->setPaper('A4', 'landscape');

        return $pdf->download('admin_frontier_report.pdf');
    }









    //for email 
    

}
