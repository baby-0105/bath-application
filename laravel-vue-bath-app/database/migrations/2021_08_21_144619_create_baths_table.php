<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * お風呂情報用 マイグレーション
 */
class CreateBathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baths', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('お風呂ID');
            $table->string('name', 30)->comment('お風呂名称');
            $table->string('url', 255)->nullable()->comment('お風呂HPのURL');
            $table->string('closing_day', 30)->nullable()->comment('休館日');
            $table->string('place', 30)->nullable()->comment('場所');
            $table->string('city', 30)->nullable()->comment('場所(市)');
            $table->string('holiday_time')->nullable()->comment('営業時間(土日祝)');
            $table->string('weekday_time')->nullable()->comment('営業時間(平日)');
            $table->float('eval_cd', 2, 1)->nullable()->comment('全体評価');
            $table->float('hot_water_eval_cd', 2, 1)->nullable()->comment('お湯評価');
            $table->float('rock_eval_cd', 2, 1)->nullable()->comment('岩盤浴評価');
            $table->float('sauna_eval_cd', 2, 1)->nullable()->comment('サウナ評価');
            $table->boolean('is_sauna')->nullable()->comment('サウナの有無');
            $table->boolean('is_rock')->nullable()->comment('岩盤浴の有無');
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
        Schema::dropIfExists('baths');
    }
}
