<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->integer('status')->comment('ユーザーの状態（仮登録、本登録、利用停止、退会）');
            $table->string('sns')->nullable()->comment('SNS名称（facebook/google）');
            $table->string('sns_id')->nullable()->comment('SNS認証用');
            $table->timestamp('email_verified_at')->nullable()->comment('本登録日時');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
