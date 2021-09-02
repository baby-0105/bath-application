<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UserInfo;

/**
 * ユーザー認証モデルクラス
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'sns', 'sns_id', 'email_verified_at', 'email_verify_token', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * ユーザーに関連するユーザー情報を取得
     *
     * @return Object ユーザー情報モデル
     */
    public function user_info()
    {
        return $this->hasOne(UserInfo::class, 'user_id', 'id');
    }

    /**
     * お気に入りとのリレーションを返す
     *
     * @return void
     */
    public function favorite()
    {
        return $this->hasMany(Favorite::class, 'user_id', 'id');
    }

    /**
     * 本登録が完了しているかどうかを返す
     *
     * @return bool true:完了、false:未完了
     */
    public function hasVerifiedEmail()
    {
        return !empty($this->email_verified_at);
    }

    /**
     * ユーザーを更新する
     *
     * @param array $user ユーザーのカラムデータ
     * @return void
     */
    public static function updateUser($user)
    {
        return self::where('id', auth()->user()->id)->update($user);
    }

    /**
     * SNS認証ユーザーが本登録が完了していない場合、trueを返す
     *
     * @param string $name sns認証ユーザー名
     * @return boolean
     */
    public static function isNonVerify($name)
    {
        return self::where('name', $name)->value('status') !== config('const.USER_STATUS.REGISTER');
    }

    /**
     * SNS認証したユーザーの取得
     *
     * @param $snsId snsId , $sns SNS名
     * @return User
     */
    public static function getSnsAuthUser($snsId, $sns)
    {
        return self::where('sns_id', $snsId)->where('sns', $sns)->first();
    }
}
