<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * メールアドレス変更 通知クラス
 */
class ResetEmail extends Notification
{
    use Queueable;
    private $encoded_token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($encoded_token)
    {
        $this->encode_token = $encoded_token;
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
        return (new MailMessage)
            ->subject('【OFLog】メールアドレス変更通知')
            ->view('email.change_email')
            ->action(
                'メールアドレス変更用URL',
                url('reset', $this->encode_token)
            );
    }
}
