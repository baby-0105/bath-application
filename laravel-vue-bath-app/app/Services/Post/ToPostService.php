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
     * 投稿を作成する
     *
     * @param array $newPostData 新しい投稿データ
     * @return Post
     */
    public function createPost($newPostData)
    {
        return Post::createPost($newPostData);
    }

    /**
     * 投稿するお風呂がすでに投稿済みかどうかを返す
     *
     * @param integer $bathId お風呂ID
     * @return boolean
     */
    public function isExistPost($bathId)
    {
        return Post::isExistPost($bathId);
    }

    /**
     * 同じ投稿を更新する
     *
     * @param integer $bathId お風呂ID
     * @param array $newPost 新しい投稿データ
     * @return Post
     */
    public function updateSamePost($bathId, $newPost)
    {
        return Post::updateSamePost($bathId, $newPost);
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
     * お風呂idから、お風呂名称取得
     *
     * @param string $id お風呂id
     * @return Bath
     */
    public function getBathName($id)
    {
        return Bath::getBathName($id);
    }
}
