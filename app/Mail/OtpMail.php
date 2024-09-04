<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class OtpMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            // subject: $this->data['subject'], // mail subject ဖြစ်နေမည်
            subject: "OTP Verification Code", // mail subject ဖြစ်နေမည်
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mailtemplate.otpmail', // mail template ထည့်ပ‌ေးရမည် 
        );
    }

    public function attachments(): array
    {
        return [];
    }
}


// php artisan make:mail OtpMail
// php artisan make:job OtpMailJob