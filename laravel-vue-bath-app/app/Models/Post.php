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
        'bath_id', 'user_id', 'title', 'thoughts', 'main_image_path',
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
     * 投稿を作成する
     *
     * @param array $newPostData 新しい投稿データ
     * @return Post
     */
    public static function createPost($newPostData)
    {
        return self::create($newPostData);
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

    /**
     * 投稿の評価の平均を返す
     *
     * @param string $title お風呂名
     * @param string $eval お風呂の評価
     * @return Post
     */
    public static function getEvalAvg($title, $eval)
    {
        return self::where('title', $title)->avg($eval);
    }

    /**
     * 投稿するお風呂がすでに投稿済みかどうかを返す
     *
     * @param integer $bathId お風呂ID
     * @return boolean
     */
    public static function isExistPost($bathId)
    {
        return self::where('user_id', auth()->id())->where('bath_id', $bathId)->exists();
    }

    /**
     * 同じ投稿を更新する
     *
     * @param integer $bathId お風呂ID
     * @param array $newPost 新しい投稿データ
     * @return Post
     */
    public static function updateSamePost($bathId, $newPost)
    {
        return self::where('user_id', auth()->id())->where('bath_id', $bathId)->update($newPost);
    }
}
