<?php

namespace App\Services\User;

use App\Models\User;

/**
 * ユーザー サービスクラス
 */

class UserService
{
    /**
     * ユーザーを更新する
     *
     * @param array $user ユーザーのカラムデータ
     * @return void
     */
    public static function updateUser($user)
    {
        return User::updateUser($user);
    }
}
