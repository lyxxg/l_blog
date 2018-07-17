<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotcie2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice2s', function (Blueprint $table) {
            $table->increments('id');
            $table->string('action')->comment("good表示点赞 msg私信   system系统通知");
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('user_object_id');
            $table->unsignedInteger('object_id');
            $table->boolean('status')->default(0)->comment("0未读  1已读");
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user_object_id')->references('id')->on('users');
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
        Schema::dropIfExists('notice2s');
    }
}
