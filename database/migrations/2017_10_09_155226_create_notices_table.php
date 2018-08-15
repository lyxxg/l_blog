<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //楼中楼站内通知
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("user_id")->comment("动态所属用户id");
            $table->string("action")->comment("动态类型，answer 表示问题被回答，comment 表示答案被评论，reply表示答案评论被回复");
            $table->unsignedInteger("object_id")->comment("如果是问题被回答，保存文章id。如果是答案被评论，保存答案id。如果是评论被回复，保存评论id,评论被评论 保存父评论id");
            $table->unsignedInteger("object_user_id")->comment("触发这个动态的用户id");
            $table->string('msg')->comment("回答/评论/回复 的内容");
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('object_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notices');
    }
}
