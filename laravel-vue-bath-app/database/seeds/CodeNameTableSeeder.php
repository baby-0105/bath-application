<?php

use Illuminate\Database\Seeder;

/**
 * code_names_tableの初期データ シーダークラス
 */
class CodeNameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 初期値の設定
        DB::table('code_names')->truncate();
        DB::table('code_names')->insert([
            ['group_key' => 'PREFECTURE', 'code' => 1, 'name' => '北海道', 'sort' => 10],
            ['group_key' => 'PREFECTURE', 'code' => 2, 'name' => '青森県', 'sort' => 20],
            ['group_key' => 'PREFECTURE', 'code' => 3, 'name' => '岩手県', 'sort' => 30],
            ['group_key' => 'PREFECTURE', 'code' => 4, 'name' => '宮城県', 'sort' => 40],
            ['group_key' => 'PREFECTURE', 'code' => 5, 'name' => '秋田県', 'sort' => 50],
            ['group_key' => 'PREFECTURE', 'code' => 6, 'name' => '山形県', 'sort' => 60],
            ['group_key' => 'PREFECTURE', 'code' => 7, 'name' => '福島県', 'sort' => 70],
            ['group_key' => 'PREFECTURE', 'code' => 8, 'name' => '茨城県', 'sort' => 80],
            ['group_key' => 'PREFECTURE', 'code' => 9, 'name' => '栃木県', 'sort' => 90],
            ['group_key' => 'PREFECTURE', 'code' => 10, 'name' => '群馬県', 'sort' => 100],
            ['group_key' => 'PREFECTURE', 'code' => 11, 'name' => '埼玉県', 'sort' => 110],
            ['group_key' => 'PREFECTURE', 'code' => 12, 'name' => '千葉県', 'sort' => 120],
            ['group_key' => 'PREFECTURE', 'code' => 13, 'name' => '東京都', 'sort' => 130],
            ['group_key' => 'PREFECTURE', 'code' => 14, 'name' => '神奈川県', 'sort' => 140],
            ['group_key' => 'PREFECTURE', 'code' => 15, 'name' => '新潟県', 'sort' => 150],
            ['group_key' => 'PREFECTURE', 'code' => 16, 'name' => '富山県', 'sort' => 160],
            ['group_key' => 'PREFECTURE', 'code' => 17, 'name' => '石川県', 'sort' => 170],
            ['group_key' => 'PREFECTURE', 'code' => 18, 'name' => '福井県', 'sort' => 180],
            ['group_key' => 'PREFECTURE', 'code' => 19, 'name' => '山梨県', 'sort' => 190],
            ['group_key' => 'PREFECTURE', 'code' => 20, 'name' => '長野県', 'sort' => 200],
            ['group_key' => 'PREFECTURE', 'code' => 21, 'name' => '岐阜県', 'sort' => 210],
            ['group_key' => 'PREFECTURE', 'code' => 22, 'name' => '静岡県', 'sort' => 220],
            ['group_key' => 'PREFECTURE', 'code' => 23, 'name' => '愛知県', 'sort' => 230],
            ['group_key' => 'PREFECTURE', 'code' => 24, 'name' => '三重県', 'sort' => 240],
            ['group_key' => 'PREFECTURE', 'code' => 25, 'name' => '滋賀県', 'sort' => 250],
            ['group_key' => 'PREFECTURE', 'code' => 26, 'name' => '京都府', 'sort' => 260],
            ['group_key' => 'PREFECTURE', 'code' => 27, 'name' => '大阪府', 'sort' => 270],
            ['group_key' => 'PREFECTURE', 'code' => 28, 'name' => '兵庫県', 'sort' => 280],
            ['group_key' => 'PREFECTURE', 'code' => 29, 'name' => '奈良県', 'sort' => 290],
            ['group_key' => 'PREFECTURE', 'code' => 30, 'name' => '和歌山県', 'sort' => 300],
            ['group_key' => 'PREFECTURE', 'code' => 31, 'name' => '鳥取県', 'sort' => 310],
            ['group_key' => 'PREFECTURE', 'code' => 32, 'name' => '島根県', 'sort' => 320],
            ['group_key' => 'PREFECTURE', 'code' => 33, 'name' => '岡山県', 'sort' => 330],
            ['group_key' => 'PREFECTURE', 'code' => 34, 'name' => '広島県', 'sort' => 340],
            ['group_key' => 'PREFECTURE', 'code' => 35, 'name' => '山口県', 'sort' => 350],
            ['group_key' => 'PREFECTURE', 'code' => 36, 'name' => '徳島県', 'sort' => 360],
            ['group_key' => 'PREFECTURE', 'code' => 37, 'name' => '香川県', 'sort' => 370],
            ['group_key' => 'PREFECTURE', 'code' => 38, 'name' => '愛媛県', 'sort' => 380],
            ['group_key' => 'PREFECTURE', 'code' => 39, 'name' => '高知県', 'sort' => 390],
            ['group_key' => 'PREFECTURE', 'code' => 40, 'name' => '福岡県', 'sort' => 400],
            ['group_key' => 'PREFECTURE', 'code' => 41, 'name' => '佐賀県', 'sort' => 410],
            ['group_key' => 'PREFECTURE', 'code' => 42, 'name' => '長崎県', 'sort' => 420],
            ['group_key' => 'PREFECTURE', 'code' => 43, 'name' => '熊本県', 'sort' => 430],
            ['group_key' => 'PREFECTURE', 'code' => 44, 'name' => '大分県', 'sort' => 440],
            ['group_key' => 'PREFECTURE', 'code' => 45, 'name' => '宮崎県', 'sort' => 450],
            ['group_key' => 'PREFECTURE', 'code' => 46, 'name' => '鹿児島県', 'sort' => 460],
            ['group_key' => 'PREFECTURE', 'code' => 47, 'name' => '沖縄県', 'sort' => 470],

            ['group_key' => 'EVAL', 'code' => 0.5, 'name' => '0.5', 'sort' => 10],
            ['group_key' => 'EVAL', 'code' => 1, 'name' => '1', 'sort' => 20],
            ['group_key' => 'EVAL', 'code' => 1.5, 'name' => '1.5', 'sort' => 30],
            ['group_key' => 'EVAL', 'code' => 2, 'name' => '2', 'sort' => 40],
            ['group_key' => 'EVAL', 'code' => 2.5, 'name' => '2.5', 'sort' => 50],
            ['group_key' => 'EVAL', 'code' => 3, 'name' => '3', 'sort' => 60],
            ['group_key' => 'EVAL', 'code' => 3.5, 'name' => '3.5', 'sort' => 70],
            ['group_key' => 'EVAL', 'code' => 4, 'name' => '4', 'sort' => 80],
            ['group_key' => 'EVAL', 'code' => 4.5, 'name' => '4.5', 'sort' => 90],
            ['group_key' => 'EVAL', 'code' => 5, 'name' => '5', 'sort' => 100],

            ['group_key' => 'IS_RELEASE', 'code' => 1, 'name' => '公開', 'sort' => 10],
            ['group_key' => 'IS_RELEASE', 'code' => 0, 'name' => '非公開', 'sort' => 20],
        ]);
    }
}
