<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Const
    |--------------------------------------------------------------------------
    */

    // 0:仮登録 10:本登録 80:利用停止 90:退会
    'USER_STATUS' => ['PRE_REGISTER' => '0', 'REGISTER' => '10', 'SUSPENTION' => '80', 'DEACTIVE' => '90',],

    // デフォルトのアイコンパス
    'default-icon' => env('DEFAULT_ICON', 'svg/bath-mark-light-blue.svg'),

    // 評価数値の定義
    'EVAL' => ['ROW_EVAL' => '0.1', 'HIGH_EVAL' => '5'],
];
