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
        'id', 'name', 'closing_day', 'place', 'city', 'holiday_time', 'weekday_time', 'eval_cd', 'hot_water_eval_cd', 'rock_eval_cd',
        'sauna_eval_cd', 'is_sauna', 'is_rock'
    ];

    /**
     * お風呂投稿とのリレーションを返す
     *
     * @return void
     */
    public function post()
    {
        return $this->hasMany(Post::class);
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
}
