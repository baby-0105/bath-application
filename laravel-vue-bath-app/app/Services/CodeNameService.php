<?php

namespace App\Services;

use App\Models\CodeName;
use Illuminate\Support\Arr;

/**
 * コード名称サービス
 */
class CodeNameService
{

    /**
     * コード名称を取得
     *
     * @param String or Array $groupKeys
     * @return コード名称
     */
    public function getCodeNames($groupKeys)
    {

        $query = CodeName::select('code', 'name')
            ->orderBy('sort', 'asc');

        // 配列の場合、複数のキーで取得
        if (is_array($groupKeys)) {
            $query->whereIn('group_key', $groupKeys);
        } else {
            $query->where('group_key', $groupKeys);
        }
        $codeNames = $query->get();

        return $codeNames;
    }

    /**
     * コード名称から名称を取得
     *
     * @param String $groupKey グループキー
     * @param String $code コード
     * @return 名称
     */
    public function getName($groupKey, $code)
    {
        return CodeName::where('group_key', $groupKey)
            ->where('code', $code)
            ->value('name');
    }

    /**
     * 指定したグループキーのコードの配列を返す
     *
     * @param String $groupKey
     * @return Array コードの配列
     */
    public function getCodes($groupKey)
    {
        $codes = CodeName::where('group_key', 'TRANSFER')
            ->orderBy('sort')
            ->get(['code'])
            ->toArray();
        return Arr::flatten($codes);
    }
}
