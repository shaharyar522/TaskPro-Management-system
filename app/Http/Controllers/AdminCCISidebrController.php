<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\UserCCI;


class AdminCCISidebrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $CCI = User::where('project_name', 'CCI')->get();

        return view('admin_sidebar.cci_user', compact('CCI'));
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
        // Get the user with project_name = CCI
        $user = User::where('id', $id)
            ->where('project_name', 'CCI')
            ->firstOrFail();

        // Get all UserFrontier records for this user
        $CCI = UserCCI::where('user_id', $id)->paginate(10);
     

        return view('admin_sidebar.cci_user_records', compact('user', 'CCI'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $userCCI = UserCCI::findOrFail($id);
        return view('admin_sidebar.edit_cci_user_records', compact('userCCI'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'master_order' => 'nullable|string',
            'job_notes' => 'nullable|string',
            'work_type' => 'required|string',
            'unit' => 'nullable|string',
            'qty' => 'nullable|numeric',
            'w2' => 'nullable|string',
            'in' => 'nullable|string',
            'out' => 'nullable|string',
            'hours' => 'nullable|numeric',
            'user_id' => 'required|exists:users,id',
        ]);

        
        $userCCI = UserCCI::findOrFail($id);

        $userCCI->update([
            'phone'         => $request->phone,
            'address'       => $request->address,
            'master_order'  => $request->master_order,
            'job_notes'     => $request->job_notes,
            'work_type'     => $request->work_type,
            'unit'          => $request->unit,
            'qty'           => $request->qty,
            'w2'            => $request->w2,
            'in'            => $request->in,
            'out'           => $request->out,
            'hours'         => $request->hours,
            'user_id'         => $userCCI->user_id,
        ]);

        return redirect()
            ->route('cci.show',$userCCI->user_id)
            ->with('success', 'User CCI data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $CCIData = UserCCI::findOrFail($id);
        $userId =  $CCIData->user_id; // Save user_id for redirect

        // Delete the record
        $CCIData->delete();

        // Redirect back to the show page with success message
        return redirect()
            ->route('cci.show', $userId)
            ->with('success', 'Record deleted successfully.');
    }
     public function exportPDF()
    {
        $admincci = UserCCI::all();

        $pdf = Pdf::loadView('admin_sidebar.pdf.admin_cci_pdf', compact('admincci'))
            ->setPaper('A4', 'landscape');

        return $pdf->download('admin_cci_report.pdf');
    }
}
