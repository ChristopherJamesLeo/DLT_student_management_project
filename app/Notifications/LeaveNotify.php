<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaveNotify extends Notification
{
    use Queueable;

    public $tbid; // table id ထပ်ခါ ပြန်ပြန်သံုးနိုင်ရန် 
    public $title;
    public $studentid;



    /**
     * Create a new notification instance.
     */
    public function __construct($id,$title,$studentid) // မည်သည့် noti ပြမည့်ကို သတ်မှတ်ရန် () ထည့်ပေးရမည် ပြပေးချင်သည့်ကောင်ကို parameter အနေဖြင့် request လုပ်ပေးရမည် 
    {
        $this -> tbid = $id;  // leave id ို ဆိုလိုသည် 
        $this -> title = $title; // 
        $this -> studentid = $studentid;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // return ['mail'];  // email ဖြင့် ပို့ချင်တာလား sms ဖြင့် ပို့ချင်တာလား သတ်မှတ်ပေးရမည် 
        return ['database'];  // email ဖြင့် ပို့ချင်တာလား sms ဖြင့် ပို့ချင်တာလား သတ်မှတ်ပေးရမည် 
    }

    /**
     * Get the mail representation of the notification.
     */

    // email မပို့သောကြောင့် မလိုအပ်ပေ
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array   //  မိမိ show ပြချင်သော blade သို့ retrun ပြန်မည်
    {
        return [ // id နှင့် title ကို ပို့ပေးမည် 
            "id" => $this -> tbid,
            "title" => $this -> title,
            "studentId" => $this -> studentid,
        ];
    }
}

