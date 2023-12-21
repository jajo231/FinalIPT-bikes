<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailNotif extends Notification
{
    use Queueable;
    private $mailNotif;

    /**
     * Create a new notification instance.
     */
    public function __construct($mailNotif)
    {
        $this->mailNotif = $mailNotif;
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
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Receipt')
                    ->greeting('Hello!')
                    ->line('Thank you for your purchase.')
                    ->line('Car: ' . $this->mailNotif['car'])
                    ->line('Purchase Date: ' . $this->mailNotif['purchaseDate'])
                    ->line($this->mailNotif['thankyou']);
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
