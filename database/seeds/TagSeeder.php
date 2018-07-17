<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table("tag_types")->insert([
            ["type_name"=>"问题"],
            ["type_name"=>"文章"],
        ]);

        \Illuminate\Support\Facades\DB::table("tags")->insert([
            ["tag_type_id"=>1,"name"=>"hacker"],
            ["tag_type_id"=>1,"name"=>"世界上最好的语言"],
            ["tag_type_id"=>2,"name"=>"文章"],
            ["tag_type_id"=>2,"name"=>"闲谈"]
        ]);
    }
}
