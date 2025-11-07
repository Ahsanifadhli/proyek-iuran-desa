<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        // Mengambil subjek dari form
        return new Envelope(
            subject: $this->data['subject'],
        );
    }

    public function content(): Content
    {
        //
        // ⬇️ INI PERBAIKANNYA ⬇️
        //
        // Arahkan ke file template, BUKAN file form
        return new Content(
            view: 'emails.sendemail',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
