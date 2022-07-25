<?php

namespace ArtMin96\FilamentPasswordLess\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdvisePassPhrase extends Notification implements ShouldQueue
{
    use Queueable;

    public $passphrase;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $passphrase)
    {
        $this->passphrase = $passphrase;
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
        return (new MailMessage())
            ->subject('Your login code for ' . config('app.name'))
            ->line('Here is your login PassPhrase which is valid for the next 15 minutes')
            ->line($this->passphrase)
            // ->action('Notification Action', url('/'))
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
            //
        ];
    }
}
