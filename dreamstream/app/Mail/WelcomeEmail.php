<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $messageBody;

    /**
     * Create a new message instance.
     *
     * @param string $username
     * @param string $messageBody
     * @return void
     */
    public function __construct($username, $messageBody)
    {
        $this->username = $username; // Ensure this is a string
        $this->messageBody = $messageBody; // Ensure this is a string
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Welcome to DreamStream!' // Custom email subject
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.Welcome-email', // Reference the view we just created
            with: [
                'username' => $this->username, // Make sure it's a string
                'message' => $this->messageBody, // Make sure it's a string
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
