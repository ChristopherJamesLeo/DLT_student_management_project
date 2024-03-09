<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

// class ContactEmailNotify extends Notification 
class ContactEmailNotify extends Notification implements ShouldQueue // Queue သံုးပါက implement ထဲမှ ShouldQueue ကိုသံုးပေးရမည်
{
    use Queueable;

    protected $data; // public / private / protected ကိြု်ကရာထားး
    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this -> data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage) // notification အတွက်လိပ်မူပြီးပို့ေသာေကြာင့်သူေပးထားသော template အတွင်း ေပးရမည်
                    ->greeting("New Contact Created") // မိတ်ဆက်စာသား
                    ->line("Full Name : ".$this->data["firstname"]." ".$this->data["lastname"])  // စာသား
                    ->line("Birthday : ".$this->data["birthday"])  // စာသား
                    ->line("Relative : ".$this->data["relative"])  // စာသား
                    // ->action('Visit Site', url('/')); // button // button သည် နှိပ်ပါက url ထဲရှိ link ထဲသို့ ဝင်သွားမည် 
                    ->action('Visit Our Site', $this->data["url"]); // button // button သည် နှိပ်ပါက url ထဲရှိ link ထဲသို့ ဝင်သွားမည် 
                    
                    // greeting => ေခါင်းစဥ် 
                    // line => စာသား
                    // action => button 
                    
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

// 1.post forward / 2. get virtual password
// gmail Integrate // မိမိ platform မှပို့စေချင်သောကြောင့် On ေပးရသည် 
// -> gmail setting -> see all settings -> forwarding POP/IMAP -> IMAP access: -> enable

// -> create vitual password
// -> tab account -> management your google account -> security -> two step verification -> on -> enter verification-> add app -> app name -> get password

// DLT students management project ->  ahkh rmta gsdz kjuk