<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContentStatusNotification extends Notification
{
    use Queueable;

    protected $post;
    protected $approval_status;

    /**
     * Create a new notification instance.
     */
    public function __construct(Post $post, $approval_status)
    {
        $this->post = $post;
        $this->approval_status = $approval_status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Content Status Updated')
                    ->greeting('Hello, ' . $notifiable->name)
                    ->line('Your post titled "' . $this->post->title . '" has been ' . $this->approval_status . '.')
                    ->action('Post_Url', url(route('admin.viewPost') . $this->post->id))
                    ->line('Thank you for using our content management system application!');
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
