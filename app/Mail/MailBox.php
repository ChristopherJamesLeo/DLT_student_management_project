<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailBox extends Mailable  // 
{
    use Queueable, SerializesModels;

    public $subject ;

    public $content;
    public function __construct($subject,$content)
    {
        $this -> subject = $subject;
        $this -> content = $content;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this -> subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            // view: 'view.name',   // email template ကို email design ေရးထားသည့် file ပတ်လမ်းကြောင်းကို ထည့်ပေးရမည် 

            view : 'mailtemplate.mailbox', // mailtemplate ထဲရှီ mailbox file ကို သံုးမည် 

            //ပေးထားသော templae ထဲသို့ data များဝင်သွားမည်ဖြစ်သည်
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];  // logo များ ထည့်ရန် သူံးသည် Templaet ထဲတွင် တစ်ခါတည်းထည့်သံုးလဲရသည် 
    }
}
