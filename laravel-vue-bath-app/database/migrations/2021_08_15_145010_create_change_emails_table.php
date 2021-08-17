<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * メールアドレス変更 マイグレーションクラス
 */
class CreateChangeEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_emails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->comment('ログインユーザー(主)');
            $table->string('new_email')->comment('新しいメールアドレス');
            $table->string('token')->comment('アクセストークン');
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
        Schema::dropIfExists('change_emails');
    }
}
