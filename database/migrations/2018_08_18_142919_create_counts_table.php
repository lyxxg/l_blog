<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //站内统计  一个月换一张表  以月分表
    public function up()
    {
        Schema::create('counts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip',15)->index()->comment("记录ip地址");
            $table->string('browser','30')->comment("用户浏览器");
            $table->boolean('is_mobile')->comment("false桌面  true移动");
            $table->timestamps();
            $table->engine='Memory';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counts');
    }
}
