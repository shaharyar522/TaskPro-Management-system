<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserMailExcelFrontier extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $filePath;
    public $messageBody;
    public $message;


    public function __construct($filePath, $username,$message,$messageBody)
    {
        $this->filePath = $filePath;
        $this->username = $username;
            $this->message = $message;
        $this->messageBody = $messageBody;
    }

    public function build()
    {
        return $this->subject($this->subject)
            ->view('emails.UserMailExcelFrontier')
            ->with([
                'messageContent' => $this->message,
                'username' => $this->username,
            ])
            ->attach($this->filePath);
    }
}
