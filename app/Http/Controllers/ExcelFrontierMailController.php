<?php

namespace App\Http\Controllers;

use App\Mail\ExcelMail;
use App\Exports\AdminUserFrontierExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;

class ExcelFrontierMailController extends Controller
{
    public function sendMail(Request $request)
    {
        $to = "webdevelopment185@gmail.com";

        // Add custom subject and message
        $subject = "Frontier Excel Export Report";
        
        $msg = "Please find attached the latest Excel export for Frontier data.";

        // Generate Excel file
        $fileName = 'frontier_export_' . time() . '.xlsx';
        $filePath = public_path('Uploads/excel_mail/' . $fileName);

        Excel::store(new AdminUserFrontierExport(), 'Uploads/excel_mail/' . $fileName, 'public_uploads');

        // Send email with subject and message
        Mail::to($to)->send(new ExcelMail($filePath, $subject, $msg));

        // Delete file after sending
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        return back()->with('success', 'Email sent successfully with Excel export.');
    }
}
