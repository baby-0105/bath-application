<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * ユーザー情報 モデルクラス
 */
class UserInfo extends Model
{
    protected $table = 'user_infos';
    protected $primaryKey = 'user_id';
    public $incrementing = false;

    protected $fillable = [
        'user_id', 'prefecture_cd', 'introduce', 'icon_path', 'is_release',
    ];

    protected $casts = [
        'is_release' => 'boolean',
    ];

    /**
     * アイコン画像パスを返す（null時→デフォルトアイコンを返す）
     *
     * @return String キャッシュバスティング付きアイコン画像パス or デフォルト画像パス
     */
    public function getIconPath()
    {
        $icon = config('const.default-icon');
        if (!empty($this->icon_path)) {
            $icon = $this->icon_path;
            return $icon . '?' . $this->updated_at->format('YmdHis');
        }
        return $icon;
    }
}
