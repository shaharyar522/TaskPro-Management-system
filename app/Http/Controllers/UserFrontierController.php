<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Models\UserFrontier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;



class UserFrontierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // this controller for start date and end date 
    public function index(Request $request)
    {
        $userId = Auth::id(); // Get current user's ID

        $query = UserFrontier::where('user_id', $userId); // Filter only current user's data

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $userfrontire = $query->paginate(10); // You can change pagination size if needed

        // If search filters were used
        if ($request->filled('start_date') || $request->filled('end_date')) {
            return view('user.dashboardFrontier', compact('userfrontire'))
                ->with('redirect_to_report', true); // This flag is for showing the report
        }

        return view('user.dashboardFrontier', compact('userfrontire'));
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


        // ✅ Validate the request (no return)
        // Validate input
        $request->validate([
            'corp_id' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'billing_TN' => 'nullable|string|max:255',
            'order_number' => 'nullable|string|max:255',
            'install_T_T_Soc_TTC' => 'nullable|string|max:255',
            'ont_Ntd' => 'nullable|string|max:255',
            'comp_or_refer' => 'nullable|string|max:255',
            'billing_code' => 'nullable|string|max:255',
            'qty' => 'nullable|integer',
            'aerial_buried' => 'nullable|string|max:255',
            'fiber' => 'nullable|string|max:255',
            'closeout_notes' => 'nullable|string|max:255',
            'in' => 'nullable|string|max:255',
            'out' => 'nullable|string|max:255',
            'hours' => 'nullable|numeric',
            'user_id' => 'required|exists:users,id',
        ]);
        // Fetch billing code data from helper
        $billingCodes = billingCodes();
        $billingCode = $request->billing_code;


        // ✅ Store using $request->all() or specific fields
        UserFrontier::create([
            'corp_id' => $request->corp_id,
            'address' => $request->address,
            'billing_TN' => $request->billing_TN,
            'order_number' => $request->order_number,
            'install_T_T_Soc_TTC' => $request->install_T_T_Soc_TTC,
            'ont_Ntd' => $request->ont_Ntd,
            'comp_or_refer' => $request->comp_or_refer,
            'billing_code' => $billingCode,
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
            'user_id' => $request->user_id,
        ]);

        return redirect()->back()->with('success', 'Your data saved successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(UserFrontier $userData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $userdata = UserFrontier::findOrFail($id);
        return view('user.frontieredit_page', compact('userdata'));
    }

    /**
     * Update the specified resource in storage.
     */



    public function update(Request $request, $id)
    {
        // ✅ Validate the request (no return)
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
            'user_id' => Auth::id(),
        ]);


        return redirect()
            ->route('user.dashboardFrontier')
            ->with('redirect_to_report', true)
            ->with('success_type', 'Updated!')
            ->with('success', 'User data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $userData = UserFrontier::findOrFail($id);
        $userData->delete();

        return redirect()
            ->route('user.dashboardFrontier')
            ->with('redirect_to_report', true)
            ->with('success_type', 'Deleted!')
            ->with('success', 'User record deleted successfully.');
    }
    public function exportPDF()
    {
        $userId = Auth::id();
        $userfrontire = UserFrontier::where('user_id', $userId)->get();
        $pdf = Pdf::loadView('user.pdf.user_frontier_pdf', compact('userfrontire'))
            ->setPaper('A4', 'landscape'); // full width in landscape
        return $pdf->download('user_frontier_report.pdf');
    }
}
