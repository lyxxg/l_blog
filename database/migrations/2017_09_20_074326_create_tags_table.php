<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("tag_type_id")->comment("所属标签分类编号");
            $table->string("ico",255)->nullable()->default("defaultico/default.png")->comment("标签图标地址");
            $table->string("name",50)->index()->comment("标签名称");
            $table->string("baike",1024)->nullable()->comment("标签介绍信息");
            $table->unsignedInteger("hot")->nullable()->default(0)->comment("标签热度，有一个问题关联，就+1，如果问题被删除，就-1");

            $table->foreign("tag_type_id")->references("id")->on("tag_types");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
