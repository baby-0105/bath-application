<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $email;
    protected $encodeToken;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $encodeToken)
    {
        $this->name        = $name;
        $this->email       = $email;
        $this->encodeToken = $encodeToken;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to(['email' => $this->email])
            ->subject('【OFLog】本登録確認メール')
            ->text('email.register_verify')
            ->with([
                'name'  => $this->name,
                'email' => $this->email,
                'token' => $this->encodeToken,
            ]);
    }
}
