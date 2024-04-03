<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address as Address;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ambition Guru',
            from: new Address('kusalsuwal5@gmail.com', 'Mail'),
        );
    }
    
    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->from('kusalsuwal5@gmail.com', 'Ambition Guru')
                    ->subject('Ambition Guru')
                    ->view('Account.verifymail')
                    ->with(['data' => $this->data]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
