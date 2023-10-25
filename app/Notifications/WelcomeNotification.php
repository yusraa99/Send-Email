<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $message;
    // public $subject;
    // public $fromEmail;
    // public $mailer;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($Message)
    {
        // $this->Message=$Message;
        // $this-> message="Welcome Our Customer";
        // $this-> subject="Hello From Yusra";
        // $this->fromEmail ="yusra.almousa.99@gmail.com";
        // $this->mailer='smtp';
        $this->message= $Message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->line($this->message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //  
        ];
    }
}
