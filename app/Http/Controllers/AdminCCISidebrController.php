<?php

namespace App\Http\Controllers;

use App\Exports\AdminUserCCIExport;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserCCI;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use App\Mail\ExcelEmail;

class AdminCCISidebrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch all users for dropdown (CCI project)
        $users = User::where('project_name', 'CCI')->orderBy('name')->get();

        // Query CCI records
        $query = UserCCI::with('user');

        // Apply date filtering
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Paginate results
        $CCI = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin_sidebar.cci_user_records', [
            'CCI' => $CCI,
            'users' => $users,
            'user' => null
        ]);
    }

    /**
     * Display the specified user CCI records.
     */
    public function show(Request $request, $id)
    {
        $user = User::where('id', $id)
            ->where('project_name', 'CCI')
            ->firstOrFail();

        $users = User::where('project_name', 'CCI')->orderBy('name')->get();

        $query = UserCCI::where('user_id', $id);

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $CCI = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin_sidebar.cci_user_records', compact('user', 'users', 'CCI'));
    }

    /**
     * Edit CCI Record.
     */
    public function edit($id)
    {
        $userCCI = UserCCI::findOrFail($id);
        return view('admin_sidebar.edit_cci_user_records', compact('userCCI'));
    }

    /**
     * Update CCI Record.
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
        ]);

        return redirect()
            ->route('cci.show', $userCCI->user_id)
            ->with('success', 'User CCI data updated successfully.');
    }

    /**
     * Delete CCI Record.
     */
    public function destroy($id)
    {
        $CCIData = UserCCI::findOrFail($id);
        $userId = $CCIData->user_id;
        $CCIData->delete();

        return redirect()
            ->route('cci.show', $userId)
            ->with('success', 'Record deleted successfully.');
    }

    /**
     * Export PDF.
     */
  public function exportPDF(Request $request)
{
    $query = UserCCI::with('user'); // include user relation

    // Filter by user_id if available
    if ($request->has('user_id') && $request->user_id != '') {
        $query->where('user_id', $request->user_id);
    }

    // Filter by date range
    if ($request->has('start_date') && $request->start_date != '') {
        $query->whereDate('created_at', '>=', $request->start_date);
    }
    if ($request->has('end_date') && $request->end_date != '') {
        $query->whereDate('created_at', '<=', $request->end_date);
    }

    $admincci = $query->get();

    // Generate PDF
    $pdf = Pdf::loadView('admin_sidebar.pdf.admin_cci_pdf', compact('admincci'))
        ->setPaper('A4', 'landscape');

    return $pdf->download('admin_cci_report.pdf');
}


    /**
     * Export Excel & Send Email.
     */
    public function exportAndSendExcel()
    {
        $export = new AdminUserCCIExport();
        $fileName = 'user_cci_export.xlsx';
        $relativePath = 'exports/' . $fileName;
        $filePath = public_path($relativePath);

        if (!File::exists(public_path('exports'))) {
            File::makeDirectory(public_path('exports'), 0755, true);
        }

        Excel::store($export, $fileName, 'public');
        copy(storage_path('app/public/' . $fileName), $filePath);

        $to = 'aatifshehzad668@gmail.com';
        Mail::to($to)->send(new \App\Mail\ExcelEmail('Attached is the exported Excel file.', 'User CCI Excel Export', $filePath));

        return redirect()->route('user.cci')->with('message', 'Email sent successfully.');
    }
}
