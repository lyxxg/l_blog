<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean("belog")->comment("1表示是回答  0表示是评论");
            $table->unsignedInteger("answer_id")->comment("被评论的回答的编号");
            $table->unsignedInteger("user_id")->comment("评论者用户编号");
            $table->unsignedInteger("comment_id")->comment("被评论的评论id");
            $table->text("comment");
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("answer_id")->references("id")->on("answers");
//            $table->foreign("object_user_id")->references("id")->on("users");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
