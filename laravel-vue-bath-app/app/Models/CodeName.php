<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * コード名称マスタモデルクラス
 */
class CodeName extends Model
{
    protected $table = 'code_names';

    protected $fillable = [
        'code',
        'name'
    ];
}
