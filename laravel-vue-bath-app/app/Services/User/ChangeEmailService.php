<?php

namespace App\Services\User;

use App\Models\ChangeEmail;

/**
 * ユーザー情報 サービスクラス
 */

class ChangeEmailService
{
    /**
     * 変更するメールアドレスの取得
     *
     * @param string $token ハッシュ化されたトークン
     * @return ChangeEmail メールアドレス変更 モデル
     */
    public function getChangeEmail($token)
    {
        return ChangeEmail::getChangeEmail($token);
    }
}
