<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserMailExcelCCI extends Mailable
{
    use Queueable, SerializesModels;

    public $filePath;
    public $subjectText;
    public $messageBody;
    public $username;

    public function __construct($filePath, $subjectText, $messageBody, $username)
    {
        $this->filePath = $filePath;
        $this->subjectText = $subjectText;
        $this->messageBody = $messageBody;
        $this->username = $username;
    }

    public function build()
    {
        return $this->subject($this->subjectText)
            ->view('emails.UserMailExcelCCI')
            ->with([
                'messageBody' => $this->messageBody,
                'username' => $this->username
            ])
            ->attach($this->filePath);
    }
}
