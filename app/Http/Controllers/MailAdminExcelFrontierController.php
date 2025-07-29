<?php

namespace App\Http\Controllers;

use App\Mail\MailAdminExcelFrontier;
use App\Exports\AdminUserFrontierExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class MailAdminExcelFrontierController extends Controller
{
    public function sendMail(Request $request)
    {
        $to = "webdevelopment185@gmail.com";

        // Get filter values
        $userId = $request->input('user_id');
        $startDate = $request->input('start_date'); // if using date filters
        $endDate = $request->input('end_date');

        // Custom subject and message

        $subject = $userId
            ? "Frontier Excel Report : " . User::find($userId)->name
            : "Frontier Excel All Users Report";

        $msg = $userId
            ? "User Name : " . User::find($userId)->name
            : "ALL Users";

        // File name
        $fileName = 'frontier_export_' . time() . '.xlsx';
        $filePath = public_path('Uploads/excel_mail/' . $fileName);

        // Generate Excel with filters

        Excel::store(
            new AdminUserFrontierExport($userId, $startDate, $endDate),
            'Uploads/excel_mail/' . $fileName,
            'public_uploads'
        );

        // Send mail // in this  adminmail this is a gloablad varialbe already email add in helpers.php
        Mail::to(adminMail())->send(new MailAdminExcelFrontier($filePath, $subject, $msg));

        // Remove file
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        return back()->with('success', 'Email sent successfully with Excel export.');
    }
}
