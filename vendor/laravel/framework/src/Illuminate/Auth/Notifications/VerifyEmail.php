<?php

namespace Illuminate\Auth\Notifications;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends Notification
{
    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }

        return (new MailMessage)
            ->subject(Lang::getFromJson('Bekræft mailadresse'))
            ->line(Lang::getFromJson('Velkommen til Datingportalen.com.'))
            ->line(Lang::getFromJson('Venligst tryk på nedenstående knap for at bekræfte din mailadresse.'))
            ->action(
                Lang::getFromJson('Bekræft mailadresse'),
                $this->verificationUrl($notifiable)
            )
            // ->line(Lang::getFromJson('If you did not create an account, no further action is required.'));
            ->line(Lang::getFromJson('Vi håber du bliver glad for at have profil hos os og at du finder hvad du søger.
                    Har du ris, ros eller forslag, så er du meget velkommen til at kontakte os på hello@datingportalen.com'))
            ->line(Lang::getFromJson('Hvis ikke du har oprettet en profil på Datingportalen.com, se venligst bort fra denne mail.
                    Har du mistanke om misbrug, kontakt os venligst på support@datingportalen.com med overskriften ”Mistanke om misbrug”.'));
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify', Carbon::now()->addMinutes(60), ['id' => $notifiable->getKey()]
        );
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}
