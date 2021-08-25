<?php

namespace App\Services\Bath;

use App\Models\Bath;

/**
 * お風呂検索 サービス
 */
class SearchService
{

    /**
     * お風呂情報を返す
     *
     * @return Bath
     */
    public function getQueryBath()
    {
        return Bath::getQueryBath();
    }
}