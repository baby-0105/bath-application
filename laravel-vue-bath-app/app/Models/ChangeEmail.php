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
     * @param string $encodedToken
     *
     */
    public function sendEmailResetNotification($encodedToken)
    {
        $this->notify(new ResetEmail($encodedToken));
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

    /**
     * 変更するメールアドレスのカラム取得
     *
     * @param string $token ハッシュ化されたトークン
     * @return ChangeEmail メールアドレス変更 モデル
     */
    public static function getChangeEmail($token)
    {
        return self::where('token', $token)->first();
    }
}
