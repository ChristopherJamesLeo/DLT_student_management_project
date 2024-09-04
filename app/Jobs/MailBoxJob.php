<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Mail\MailBox;
use Illuminate\Support\Facades\Mail;

class MailBoxJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $subject ;
    public $content;
    public $to;
    public function __construct($to,$subject,$content)
    {
        $this -> subject = $subject;
        $this -> content = $content;
        $this -> to = $to;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->to)->send(new MailBox($this->subject,$this->content)); // handle လုပ်ပြီး Mail ပို့မည် 
    }
}


// php artisan make:job MailBoxJob
// php artisan queue:table 