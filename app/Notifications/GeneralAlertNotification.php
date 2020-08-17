<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * This notification is for database handling of general 
 * alerts using the alert subscriptions within the app
 */
class GeneralAlertNotification extends Notification
{
    use Queueable;

    public $event;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($event)
    {
        $this->event = $event; 
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'described' => $this->event->described,
            'entityName' => $this->event->entityName,
            'entityId' => $this->event->entityId,
            'showRoute' => $this->event->showRoute,
        ];
    }
}
