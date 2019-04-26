<?php

namespace Illuminate\Auth\Notifications;

use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

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
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return (new MailMessage)
            ->subject(Lang::getFromJson('Nulstil kodeord'))
            ->line(Lang::getFromJson('Du modtager denne mail fordi vi har modtaget en anmodning om at du vil have nulstillet dit kodeord.'))
            ->action(Lang::getFromJson('Nulstil kodeord'), url(config('app.url').route('password.reset', $this->token, false)))
            ->line(Lang::getFromJson('Dette link udløber om :count minutter fra modtagelse.', ['count' => config('auth.passwords.users.expire')]))
            ->line(Lang::getFromJson('Hvis du ikke har bedt om at få nulstilet din kode, behøver du ikke at gøre noget.
                Har du mistanke om misbrug af din konto, skriv venligst til: support@datingportalen.com med overskriften ”Mistanke om misbrug af konto”.'))
            ->line(Lang::getFromJson('Vi håber du er glad for vores side og modtager gerne både ris og ros på hello@datingportalen.com.'));
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
