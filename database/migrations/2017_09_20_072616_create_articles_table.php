<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //文章表

        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string("title")->index()->comment("文章标题");
            $table->text('content')->comment("文章详情");
            $table->unsignedInteger("user_id")->comment("发布文章的用户编号");
            $table->unsignedInteger("view")->nullable()->default(0)->comment("浏览量");
            $table->unsignedInteger("collection")->nullable()->default(0)->comment("收藏量");
            $table->tinyInteger("del")->index()->nullable()->default(0)->comment("0表示未撤销   1表示撤销");
            $table->timestamps();

        });

    }

    /**.
     *
     * Reverse the migrations
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Articles');
    }
}
