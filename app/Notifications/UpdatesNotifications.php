<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdatesNotifications extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $message;
    private $username;
    private $user_id;
    private $link;
    public function __construct($message, $user_id, $username, $link)
    {
        $this->message = $message;
        $this->user_id = $user_id;
        $this->username = $username;
        $this->link = $link;
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
           'message' => $this->message,
           'by' => $this->username,
           'by_user_id' => $this->user_id,
           'link' => $this->link
        ];
    }
}
