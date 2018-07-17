<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannedusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //违禁用户表  感觉不是经常使用  所以特创建一个表
        Schema::create('bannedusers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('object_user_id');//管理员的id
            $table->string('content')->default('违反规定');//禁言理由
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('object_user_id')->references('id')->on('users');
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
        Schema::dropIfExists('bannedusers');
    }
}
