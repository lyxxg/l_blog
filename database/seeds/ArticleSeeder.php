<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Article::class, 50)->create()->each(function($q) {
            $q->save();

            $t = new \App\Models\ArticleTag();
            $t->article_id = $q->id;
            $t->tag_id=1;
            $t->save();

            $t = new \App\Models\ArticleTag();
            $t->article_id = $q->id;
            $t->tag_id=2;
            $t->save();
        });
    }
}
