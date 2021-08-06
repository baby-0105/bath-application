<?php

namespace App\Service\User;

use App\Mail\EmailVerification;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

/**
 * 新規登録 サービスクラス
 */
class RegisterService{

    /**
     * 新規登録と、メール送信
     *
     * @package App\Service\User
     */
    public function sendAndCreate($valueObject)
    {
        $user = new User($valueObject);
        $user->password           = Hash::make($user->password);
        $user->email_verify_token = Hash::make($user->email_verify_token);
        $user->save();

        $email       = $user->email;
        $encodeToken = base64_encode($user->email_verify_token);

        Mail::send(new EmailVerification($email, $encodeToken));
    }

    /**
     * トークンは使用可能かチェック
     *
     * @param [type] $token
     * @return boolean
     */
    public function canUseToken($token)
    {
        return User::where('email_verify_token',base64_decode($token))->exists();
    }

    /**
     * すでに本登録済みのユーザー
     *
     * @param [type] $token
     * @return status or null
     */
    public function verifiedUser($token)
    {
        $user = User::where('email_verify_token', base64_decode($token))->first();

        return $user->status == config('const.USER_STATUS.REGISTER') && !$user->email_verified_at == null;
    }

    /**
     * ユーザー情報の更新→本登録
     *
     * @return void
     */
    public function updatedUser($token)
    {
        $user = User::where('email_verify_token', base64_decode($token))->first();
        $user->status = config('const.USER_STATUS.REGISTER');
        $user->email_verified_at  = now();
        return $user->save();
    }
}
