<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExcelEmail;


class MailController extends Controller
{
    public function sendEmail()
    {
        $to = "shaharyar.khan4511@gmail.com";
        $msg = "This is your Excel report.";
        $subject = "Excel Report Attached";

        // Example path (ensure file exists here)
        $filePath = public_path('excel_files/sample2.xlsx'); // or storage_path()

        if (!file_exists($filePath)) {
            return "File not found at: $filePath";
        }

        Mail::to($to)->send(new ExcelEmail($msg, $subject, $filePath));

        return "Email sent with attachment.";
    }
}
