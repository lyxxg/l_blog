<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\Article;
use App\Models\Tag;
use App\Services\BlogService;
use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    //视图数据共享
    public function boot()
    {

        //公告
       $announcement=\Redis::get("announcement");
        if(empty($announcement)) {
        $announcement = Announcement::all()->last();
        \Redis::set("announcement", $announcement);
        }
        $announcement=json_decode($announcement);



        //热门文章  阅读量前10的文章
        $articlehots=\Redis::get("articlehots");
        if(empty($articlehots)){
        $articlehots=Article::all()->sortByDesc('view')->take(10);

        //注意 是key timeout  value
        \Redis::setex("articlehots",20,$articlehots);
//                 \Redis::set("articlehots",$articlehots,20);
        }
        $articlehots=json_decode($articlehots);


        //所有分类
        $blogtags=\Redis::get("futruetags");
        if(empty($blogtags)){
        $blogtags=Tag::all();
        \Redis::set("futruetags",$blogtags);
        }
        $blogtags=json_decode($blogtags);


        view()->share("blogtags",$blogtags);
        view()->share('announcement',$announcement);
        view()->share('articlehots',$articlehots);

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        //博客门面
        $this->app->singleton('blog.manage',function ($app){

            return new BlogService();
        });



    }
}
