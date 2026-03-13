<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JobAlertNotification extends Notification
{
    use Queueable;

    public $job;

    /**
     * Create a new notification instance.
     */
    public function __construct($job)
    {
        $this->job = $job;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('وظيفة جديدة تطابق معاييرك')
            ->line($this->job->title)
            ->action('عرض الوظيفة', url('/jobs/'.$this->job->id));
    }

    public function toDatabase($notifiable)
    {
        return [
            'job_id' => $this->job->id,
            'message'=>$this->job->title,
            'title' => $this->job->title,
        ];
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
