<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;



class OTPMail extends Mailable
{
    use Queueable, SerializesModels;
    public $otp;
    public $purpose;
    public $subject;

    /**
     * Create a new message instance.
     */
    public function __construct($otp, $purpose)
    {
        $this->otp = $otp;
        $this->purpose = $purpose; // 'forgot_password' or 'two_factor'
        $this->subject = ($purpose === 'forgot_password') ? 'Password Reset Code' : 'Two-Factor Authentication Code ';
    }




    public function build()
    {
        $subject = ($this->purpose === 'forgot_password') ? 'Password Reset Code' : 'Two-Factor Authentication Code';
        $view = ($this->purpose === 'forgot_password') ? 'emails.forgot_password' : 'emails.otp';

        return $this->subject($subject)
                    ->markdown($view)
                    ->with(['otp' => $this->otp]); // Pass $otp to the view
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
