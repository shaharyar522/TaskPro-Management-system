<?php

namespace App\Http\Controllers;

use App\Mail\MailAdminExcelCCI;
use App\Exports\AdminUserCCIExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class MailAdminExcelCCIController extends Controller
{
    public function sendMail(Request $request)
    {
        $to = "webdevelopment185@gmail.com";

        // Get filter values
        $userId = $request->input('user_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Set dynamic subject and message
        $subject = $userId
            ? "CCI Excel Report : " . User::find($userId)->name
            : "CCI Excel All Users Report";

        $msg = $userId
            ? "User Name : " . User::find($userId)->name
            : "ALL Users";

        $fileName = 'cci_export_' . time() . '.xlsx';
        $filePath = public_path('Uploads/excel_mail/' . $fileName);
        // Generate Excel with filters
        try {
            Excel::store(
                new AdminUserCCIExport($userId, $startDate, $endDate),
                'Uploads/excel_mail/' . $fileName,
                'public_uploads'
            );
        } catch (\Exception $e) {
            return back()->with('error', 'Error generating the Excel file: ' . $e->getMessage());
        }

        // Check if file exists
        if (!file_exists($filePath)) {
            return back()->with('error', 'Generated file not found.');
        }

        // Send mail
        try {
            // in this  adminmail this is a gloablad varialbe already email add in helpers.php
            Mail::to(adminMail())->send(new MailAdminExcelCCI($filePath, $subject, $msg));
        } catch (\Exception $e) {
            return back()->with('error', 'Error sending email: ' . $e->getMessage());
        }

        // Remove file after sending
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        return back()->with('success', 'Email sent successfully with CCI Excel export.');
    }
}
