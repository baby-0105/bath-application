<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * お風呂情報 モデル
 */
class Bath extends Model
{

    protected $table = 'baths';

    protected $fillable = [
        'id', 'name', 'url', 'closing_day', 'place', 'city', 'holiday_time', 'weekday_time', 'eval_cd', 'hot_water_eval_cd', 'rock_eval_cd',
        'sauna_eval_cd', 'is_sauna', 'is_rock'
    ];

    /**
     * お風呂投稿とのリレーションを返す
     *
     * @return void
     */
    public function post()
    {
        return $this->hasMany(Post::class, 'bath_id', 'id');
    }

    /**
     * お気に入りとのリレーションを返す
     *
     * @return void
     */
    public function favorite()
    {
        return $this->hasMany(Favorite::class, 'bath_id', 'id');
    }

    /**
     * お風呂情報を返す
     *
     * @return Bath
     */
    public static function getQueryBath()
    {
        return self::query();
    }

    /**
     * 特定のお風呂情報を更新して返す
     *
     * @param string $name お風呂名
     * @param array $updateData 更新するデータ
     * @return Bath
     */
    public static function updateTheBath($name, $updateData)
    {
        return self::where('name', $name)->update($updateData);
    }

    /**
     * お風呂idから、お風呂名称取得
     *
     * @param string $id お風呂id
     * @return Bath
     */
    public static function getBathName($id)
    {
        return self::where('id', $id)->value('name');
    }
}
