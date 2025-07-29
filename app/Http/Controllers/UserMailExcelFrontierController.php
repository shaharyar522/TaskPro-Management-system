<?php

namespace App\Http\Controllers;

use App\Exports\UserFrontierExport;
use App\Mail\UserMailExcelFrontier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserMailExcelFrontierController extends Controller
{
    public function sendExcel(Request $request)
    {
        try {
            $user = Auth::user();
            $username = $user->name;

            $fileName = 'user_frontier_' . $user->id . '_' . now()->timestamp . '.xlsx';
            $relativePath = 'Uploads/user_frontier/' . $fileName;
            $directory = public_path('Uploads/user_frontier');
            $fullPath = public_path($relativePath);

            // Create directory if not exists
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            // Save Excel file to public directory using custom disk
            Excel::store(new UserFrontierExport, $relativePath, 'public_uploads', \Maatwebsite\Excel\Excel::XLSX);

            // Log the file path after saving
            Log::info("Excel file stored at: $fullPath");

            // Email subject
            $subject = 'Frontier Dashboard User Record - Submitted by ' . $username;

             // in this  adminmail this is a gloablad varialbe already email add in helpers.php
            Mail::to(adminMail())->send(
                new UserMailExcelFrontier($fullPath, $subject, 'Please check the attached file.', $username)
            );

            // Log email sent
            Log::info("Email sent to: " . adminMail());

            // Delete file after sending
            if (File::exists($fullPath)) {
                File::delete($fullPath);
            }

            return redirect()->back()->with('success', 'Email sent with Excel attached!');
        } catch (\Exception $e) {
            Log::error('Excel email failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to send email. Please check logs.');
        }
    }
}
