<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //用户信息
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->increments('user_id')->comment("主键同时也是外键");
            $table->string('savatar',100)->comment("头像的略缩图");
            $table->string('avatar',255)->nullable()->comment("用户头像地址");
            $table->string('nick',20)->comment("用户昵称");
            $table->unsignedInteger('coins')->default(60)->comment("用户积分");
            $table->string("description")->nullable()->comment("个人描述")->default('这个人很懒');
            $table->unsignedInteger('Fans')->nullable()->default(0)->comment("粉丝数");
            $table->unsignedInteger('collection_id')->nullable()->default(0)->comment("收藏的文章");
            $table->unsignedInteger('sex')->default("3")->comment("0女  1男 3保密");
            $table->timestamps();
 //           $table->foreign("user_id")->references('id')->on('users');

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
