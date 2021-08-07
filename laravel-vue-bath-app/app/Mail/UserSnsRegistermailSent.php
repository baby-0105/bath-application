<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

/**
 * ユーザーSNS登録完了メールクラス
 */
class UserSnsRegisterMailSent extends Mailable
{
    use Queueable, SerializesModels;

    private $name;
    private $title = '【OFLog】SNS登録通知';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->title)
            ->text('email.user_sns_register', [
                'name' => $this->name,
            ]);
    }
}
