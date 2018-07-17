<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msgs', function (Blueprint $table) {
            $table->increments('id');
$table->unsignedInteger("user_id")->comment("user_id发送");
$table->unsignedInteger("user_object_id")->comment("user_obkect_id接收");
$table->text("msg");
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
        Schema::dropIfExists('msgs');
    }
}
