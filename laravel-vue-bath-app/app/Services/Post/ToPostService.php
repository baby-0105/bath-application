<?php

namespace App\Services\Post;

use App\Models\Bath;
use App\Models\Post;

/**
 * お風呂投稿 サービスクラス
 */

class ToPostService
{
    /**
     * 投稿の評価の平均を返す
     *
     * @param string $title お風呂名
     * @param string $eval お風呂の評価
     * @return Post
     */
    public function getEvalAvg($title, $eval)
    {
        return Post::getEvalAvg($title, $eval);
    }

    /**
     * 特定のお風呂情報を更新して返す
     *
     * @param string $name お風呂名 $updateData 更新するデータ
     * @return Bath
     */
    public function updateTheBath($name, $updateData)
    {
        return Bath::updateTheBath($name, $updateData);
    }

    /**
     * 投稿を作成する
     *
     * @param array $newPostData 新しい投稿データ
     * @return Post
     */
    public function createPost($newPostData)
    {
        return Post::createPost($newPostData);
    }
}
