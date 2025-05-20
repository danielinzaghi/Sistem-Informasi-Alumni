<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class CustomResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Reset Kata Sandi Akun Anda')
            ->greeting('Halo!')
            ->line('Kami menerima permintaan untuk mereset kata sandi Anda.')
            ->action('Reset Kata Sandi', $url)
            ->line('Jika Anda tidak meminta reset, abaikan saja email ini.')
            ->salutation('Salam, Sistem Alumni');
    }
}
