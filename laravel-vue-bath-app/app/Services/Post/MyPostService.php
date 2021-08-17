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
    public function getMyPost()
    {
        return Post::getMyPost();
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
}
