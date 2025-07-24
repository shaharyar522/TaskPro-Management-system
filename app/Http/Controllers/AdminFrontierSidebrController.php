<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserFrontier;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class AdminFrontierSidebrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    // Base query for all users with project_name = 'Frontier'
    $query = User::where('project_name', 'Frontier');

    // If search filters are applied, filter by dates
    if ($request->filled('start_date') || $request->filled('end_date')) {
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
    }

    // Paginate the results
    $frontiers = $query->orderBy('created_at', 'desc')->paginate(10);

    // Return the view
    return view('admin_sidebar.frontier_user', compact('frontiers'));
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
        // Get the user with project_name = Frontier
        $user = User::where('id', $id)
            ->where('project_name', 'Frontier')
            ->firstOrFail();

        // Get all UserFrontier records for this user
        $frontiers = UserFrontier::where('user_id', $id)->paginate(10);

        // Return the new view
        return view('admin_sidebar.frontier_user_records', compact('user', 'frontiers'));
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
            'user_id' => $userData->user_id,
        ]);


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
            ->route('frontier.show', $userId)
            ->with('success', 'Record deleted successfully.');
    }


    public function exportPDF()
    {
        $adminfrontire = UserFrontier::all();

    $pdf = Pdf::loadView('admin_sidebar.pdf.admin_frontier_pdf', compact('adminfrontire'))
        ->setPaper('A4', 'landscape');

    return $pdf->download('admin_frontier_report.pdf');
    }
}
