<?php

namespace App\Models;

use App\Notifications\ResetEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * ログイン後：メールアドレス変更 モデル
 */
class ChangeEmail extends Model
{
    use Notifiable;

    protected $fillable = [
        'user_id', 'new_email', 'token',
    ];

    /**
     * メールアドレス確定メールを送信
     *
     * @param [type] $encoded_token
     *
     */
    public function sendEmailResetNotification($encoded_token)
    {
        $this->notify(new ResetEmail($encoded_token));
    }

    /**
     * 新しいメールアドレスあてにメールを送信する
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForMail($notification)
    {
        return $this->new_email;
    }
}
