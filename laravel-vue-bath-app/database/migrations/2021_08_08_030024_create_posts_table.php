<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * お風呂投稿 マイグレーションクラス
 */
class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bath_id')->comment('お風呂ID');
            $table->integer('user_id')->comment('投稿したユーザーのID');
            $table->string('title', 30)->comment('お風呂名');
            $table->string('thoughts', 240)->nullable()->comment('感想');
            $table->string('main_image_path', 150)->nullable()->comment('お風呂の画像パス メイン');
            $table->string('sub_picture1_path', 150)->nullable()->comment('お風呂の画像パス サブ1');
            $table->string('sub_picture2_path', 150)->nullable()->comment('お風呂の画像パス サブ2');
            $table->string('sub_picture3_path', 150)->nullable()->comment('お風呂の画像パス サブ3');
            $table->float('eval_cd', 2, 1)->comment('全体評価');
            $table->float('hot_water_eval_cd', 2, 1)->nullable()->comment('お湯評価');
            $table->float('rock_eval_cd', 2, 1)->nullable()->comment('岩盤浴評価');
            $table->float('sauna_eval_cd', 2, 1)->nullable()->comment('サウナ評価');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('登録日');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('更新日');
            $table->timestamp('deleted_at')->nullable()->comment('削除日');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
