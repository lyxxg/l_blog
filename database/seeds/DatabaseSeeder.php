<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    /*
    填充内容
    1.用户 用户信息 用户rbac
    2.标签 标签分类
    3.文章
    4.轮播图
    5.后台浏览器统计数据
    */
    public function run()
    {
//        $this->call(UserSeeder::class);
//        $this->call(TagSeeder::class);
//        $this->call(ArticleSeeder::class);
//        $this->call(FocusSeeder::class);
        $this->call(BrowserSeeder::class);
    }
}
