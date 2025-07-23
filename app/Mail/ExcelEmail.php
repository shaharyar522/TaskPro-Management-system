<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class ExcelEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $msg;
    public $subject;
    public $filePath;

    /**
     * Create a new message instance.
     */
    public function __construct($msg, $subject, $filePath)
    {
        $this->msg = $msg;
        $this->subject = $subject;
        $this->filePath = $filePath;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.excelemail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        if (file_exists($this->filePath)) {
            return [
                Attachment::fromPath($this->filePath)
                    ->as('report.xlsx') // optional custom name
                    ->withMime('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'),
            ];
        }

        return [];
    }
}
