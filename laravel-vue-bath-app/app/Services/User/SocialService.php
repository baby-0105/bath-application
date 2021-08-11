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
}
