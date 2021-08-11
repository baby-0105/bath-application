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
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
