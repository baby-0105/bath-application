<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * SNS認証 サービスクラス
 *
 * @package App\Services\User
 *
 */

class SocialService{

	/**
	 * DBから認証されたユーザー取得
	 *
	 * @return void
	 */
	public function selectAuthUser($user, $sns)
	{
		return User::where('sns_id', $user->id)->where('sns', $sns)->orWhere('email', $user->email)->first();
    }

	/**
	 * DBとの一致確認処理
	 *
	 * @return void
	 */
	public function matchConfirmation($user, $sns)
	{
		return User::where('sns_id', $user->id)->orWhere('email', $user->email)->first()->where('sns', $sns)->value('sns') == $sns;
    }

	/**
	 * ログイン処理
	 *
	 */
	public function toLoginUser($user, $sns)
	{
		$authUser = User::where('sns_id', $user->id)->where('sns', $sns)->first();
		return Auth::login($authUser);
	}

	/**
     * SNS認証ユーザーが本登録が完了していない場合、trueを返す
     *
     * @param string $name sns認証ユーザー名
     * @return User ユーザーモデル
     */
    public function isNonVerify($name)
    {
        return User::isNonVerify($name);
	}

    /**
     * SNS認証したユーザーの取得
     *
     * @param $snsId snsId , $sns SNS名
     * @return User
     */
    public static function getSnsAuthUser($snsId, $sns)
    {
        return User::getSnsAuthUser($snsId, $sns);
    }
}
