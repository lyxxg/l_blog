<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * ----------
        id
        type_name    varchar(50)    标签名
        order_id    int                分类排序编号，越小越靠前
         */
        Schema::create('tag_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type_name', 50);
            $table->unsignedInteger('order_id')->nullable()->default(0)->comment("分类排序编号，越小越靠前");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_types');
    }
}
