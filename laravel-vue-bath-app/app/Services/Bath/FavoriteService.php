<?php

namespace App\Services\Bath;

use App\Models\Favorite;

/**
 * お風呂お気に入り サービス
 */
class FavoriteService
{
    /**
     * お気に入りに追加する
     *
     * @param array $data お気に入り情報
     * @return void
     */
    public function addFavorite($data)
    {
        Favorite::addFavorite($data);
    }

    /**
     * お気に入りを解除する
     *
     * @param integer $bathId お風呂ID
     * @return Favorite
     */
    public function unFavorite($bathId)
    {
        Favorite::unFavorite($bathId);
    }
}