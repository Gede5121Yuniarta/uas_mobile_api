<?php

namespace App\Mail;

use App\Models\Click;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClickNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $click;

    /**
     * Create a new message instance.
     */
    public function __construct(Click $click)
    {
        $this->click = $click;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Click on Your Kost')
                    ->view('emails.click_notification');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Click Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
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
