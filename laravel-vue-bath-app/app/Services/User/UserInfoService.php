<?php

namespace App\Services\User;

use App\Models\UserInfo;

/**
 * ユーザー情報 サービスクラス
 */

class UserInfoService
{
    /**
     * ユーザー情報の取得
     */
    public function getUserInfo()
    {
        return UserInfo::getUserInfo();
    }

    /**
     * ユーザー情報を更新する
     *
     * @param array $userInfo ユーザー情報のカラムデータ
     * @return void
     */
    public static function updateUserInfo($userInfo)
    {
        return UserInfo::updateUserInfo($userInfo);
    }
}
