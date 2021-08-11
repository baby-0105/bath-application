<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * コード名称マスタ生成 マイグレーションクラス
 */
class CreateCodeNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_names', function (Blueprint $table) {
            $table->string('group_key', 20);
            $table->string('code', 30);
            $table->string('name', 100);
            $table->string('parent', 30)->nullable();
            $table->integer('sort')->default(0);

            $table->primary(['group_key', 'code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('code_names');
    }
}
