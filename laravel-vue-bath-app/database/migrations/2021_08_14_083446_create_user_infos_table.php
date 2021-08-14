<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * ユーザー情報 テーブルクラス
 */
class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->bigInteger('user_id', false, true)->primary()->comment('ユーザーID（主）');
            $table->string('prefecture_cd', 30)->nullable()->comment('都道府県');
            $table->string('introduce', 120)->nullable()->comment('自己紹介');
            $table->string('icon_path', 150)->nullable()->comment('ユーザーアイコン');
            $table->boolean('is_release')->comment('公開 / 非公開');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_infos');
    }
}
