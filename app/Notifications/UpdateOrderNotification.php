<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateOrderNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $userName;
    protected $order;


    /**
     * Create a new notification instance.
     */
    public function __construct($userName,$order)
    {
        $this->userName = $userName; 
        $this->order = $order; 

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
        return (new MailMessage)
            ->subject('تحديث حالة الطلب      ')
            ->line("عزيزي {$this->userName}، تم تحديث حالة طلبك إلى: {$this->order}.")
            ->action(' طلباتي  ', url('/my_orders'))
            ->line('Thank you for using our application!');
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
