<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExcelMail extends Mailable
{
    use Queueable, SerializesModels;

    public $filePath;
    public $subjectText;
    public $msg;

    public function __construct($filePath, $subjectText = 'Frontier Excel Export', $msg = '')
    {
        $this->filePath = $filePath;
        $this->subjectText = $subjectText;
        $this->msg = $msg;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectText
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.excel_mail',
            with: [
                'msg' => $this->msg
            ]
        );
    }

    public function attachments(): array
    {
        return [
            \Illuminate\Mail\Mailables\Attachment::fromPath($this->filePath)
        ];
    }
}
