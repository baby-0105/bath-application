<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * お風呂投稿 モデルクラス
 */
class Post extends Model
{
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'posts';

    protected $fillable = [
        'user_id', 'title', 'thoughts', 'main_image_path',
        'sub_picture1_path', 'sub_picture2_path', 'sub_picture3_path', 'sub_picture4_path',
        'eval_cd', 'hot_water_eval_cd', 'rock_eval_cd', 'sauna_eval_cd',
    ];

    /**
     * ユーザーとのリレーションを返す
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * ログインユーザーの投稿を返す(最新投稿順)
     *
     * @return collection ログインユーザーの投稿全て
     */
    public static function getMyPost()
    {
        return self::where('user_id', auth()->user()->id)->latest()->get();
    }

    /**
     * 投稿を削除する処理
     *
     * @param $postId 投稿ID
     * @return void
     */
    public static function deletePost($postId)
    {
        return self::where('id', $postId)->delete();
    }
}
