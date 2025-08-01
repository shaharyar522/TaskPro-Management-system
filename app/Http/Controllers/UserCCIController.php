<?php

namespace App\Http\Controllers;

use App\Exports\UserCCIExport;
use App\Models\UserCCI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\Mail;
use App\Mail\ExcelEmail;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class UserCCIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = Auth::id(); // Get current user's ID

        $query = UserCCI::where('user_id', $userId); // Filter only current user's data

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $userCCI = $query->paginate(10);  // You can change pagination size if needed

        // If search filters were used
        if ($request->filled('start_date') || $request->filled('end_date')) {
            return view('user.dashboardCCI', compact('userCCI'))
                ->with('redirect_to_report', true); // This flag is for showing the report
        }

        return view('user.dashboardCCI', compact('userCCI'));
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
        $user = Auth::user();


        UserCCI::create([
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
            'user_id'         => $user->id,
        ]);

        return redirect()->back()->with('success', 'CCI Data saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserCCI $userCCI)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $userCCI = UserCCI::findOrFail($id);
        return view('user.cciedit', compact('userCCI'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
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

        $user = Auth::user();
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
            'user_id'         => $user->id,
        ]); 

        return redirect()
            ->route('user.dashboardCCI')
            ->with('redirect_to_report', true)
            ->with('success_type', 'Updated!')
            ->with('success', 'User CCI data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {

        $usercci = UserCCI::findOrFail($id);
        $usercci->delete();

        return redirect()
            ->route('user.dashboardCCI')
            ->with('redirect_to_report', true)
            ->with('success_type', 'Deleted!')
            ->with('success', 'CCI record will be permanently deleted successfully.');
    }

    public function exportPDF()
    {
        $userId = Auth::id();
        $userCCI = UserCCI::where('user_id', $userId)->get();

        $pdf = Pdf::loadView('user.pdf.user_cci_pdf', compact('userCCI'))
            ->setPaper('A4', 'landscape'); // full width in landscape

        return $pdf->download('user_cci_report.pdf');
    }
}
