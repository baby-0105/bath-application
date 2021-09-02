<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * お気に入りテーブル用 モデル
 */
class Favorite extends Model
{

    /** モデルと関連するテーブル favorites */
    protected $table = 'favorites';

    protected $fillable = ['user_id', 'bath_id'];

    /**
     * ログインユーザーとのリレーションを返す
     *
     * @return void
     */
    public function user()
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }

    /**
     * お風呂とのリレーションを返す
     *
     * @return void
     */
    public function bath()
    {
        return $this->hasMany(Bath::class, 'bath_id', 'id');
    }

    /**
     * お気に入りに追加する
     *
     * @param array $data お気に入り情報
     * @return void
     */
    public static function addFavorite($data)
    {
        self::create($data);
    }

    /**
     * お気に入りを解除する
     *
     * @param integer $bathId お風呂ID
     * @return Favorite
     */
    public static function unFavorite($bathId)
    {
        self::where('bath_id', $bathId)->delete();
    }
}
