<?php

namespace App\Services\Post;

use App\Models\Post;

/**
 * My投稿 サービスクラス
 */

class MyPostService
{
    /**
     * ログインユーザーの投稿を返す
     *
     * @return void
     */
    public function getLatestMyPost()
    {
        return Post::getLatestMyPost();
    }

    /**
     * 投稿を削除する処理
     *
     * @param $postId 投稿ID
     * @return void
     */
    public function deletePost($postId)
    {
        return Post::deletePost($postId);
    }

    /**
     * ログインユーザーの投稿を評価の高い順にして返す
     *
     * @param string $eval 評価のカラム
     * @return Post
     */
    public function getHighEvalOrder($eval)
    {
        return Post::getHighEvalOrder($eval);
    }
}
