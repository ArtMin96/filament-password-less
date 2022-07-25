<?php

namespace ArtMin96\FilamentPasswordLess\Notifications;

use ArtMin96\FilamentPasswordLess\FilamentPasswordLess;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class AdvisePassPhraseMagicLink extends Notification implements ShouldQueue
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
            ->line('Here is your login PassPhrase which is valid for the next 15 minutes')
            ->line($this->passphrase)
            ->line('Or click the button to access the site (opens in a new window)')
            ->action('Confirm', URL::temporarySignedRoute(
                'filament.auth.login.magiclink',
                now()->addMinutes(app(FilamentPasswordLess::class)->passPhraseExpiry()),
                ['userId' => $notifiable->id, 'code' => $this->passphrase]
            ))
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
