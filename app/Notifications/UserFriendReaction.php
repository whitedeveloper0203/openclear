<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\User;

class UserFriendReaction extends Notification implements ShouldQueue
{
    use Queueable;

    protected $sender;
    protected $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $sender, $message = null)
    {
        //
        $this->sender = $sender;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'message' => $this->message,
                'sender_id' => $this->sender->id,
                'sender_name' => $this->sender->fullName(),
                'sender_avatar' => $this->sender->profilePhoto(),
            ],
        ];
    }

    /**
     * Get the Database representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
            'sender_id' => $this->sender->id,
            'sender_name' => $this->sender->fullName(),
            'sender_avatar' => $this->sender->profilePhoto(),
        ];
    }
}
