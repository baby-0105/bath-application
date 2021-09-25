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
	 * @return boolean 
	 */
	public function matchConfirmation($user, $sns)
	{
		return User::where('sns_id', $user->id)
					->orWhere('email', $user->email)
					->first()
					->where('sns', $sns)
					->value('sns')
					== $sns;
    }

	/**
	 * SNS認証をしたユーザーのログイン処理
	 *
	 * @param $snsId snsId , $sns SNS名
	 */
	public function toLoginUser($snsId, $sns)
	{
		$authUser = User::getSnsAuthUser($snsId, $sns);
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
}
