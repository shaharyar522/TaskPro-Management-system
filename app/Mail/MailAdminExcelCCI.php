<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailAdminExcelCCI extends Mailable
{
    use Queueable, SerializesModels;

    public $filePath;
    public $subjectText;
    public $msg;

    public function __construct($filePath, $subjectText = 'CCI Excel Export', $msg = '')
    {
        $this->filePath = $filePath;
        $this->subjectText = $subjectText;
        $this->msg = $msg;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectText // Dynamic subject
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.MailAdminExcelCCI', // Use the common email view
            with: [
                'msg' => $this->msg // Message passed to the view
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            \Illuminate\Mail\Mailables\Attachment::fromPath($this->filePath)->as('CCI_Export.xlsx'),
        ];
    }
}
