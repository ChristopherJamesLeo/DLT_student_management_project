<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AnnouncementNotify extends Notification
{
    use Queueable;

    protected $tbid;
    protected $title;
    protected $image;

    public function __construct($id,$title,$image)
    {
        $this -> tbid = $id;
        $this -> title = $title;
        $this -> image = $image;
    }



    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            "id" => $this -> tbid,
            "title" => $this -> title,
            "image" => $this -> image
        ];
    }
}
