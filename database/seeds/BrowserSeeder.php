<?php

use Illuminate\Database\Seeder;

class BrowserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
   {
     foreach (\App\Facades\BlogFacade::AllBrowser() as $browser)
     {
         $i=rand(30,130);
         while ($i-->20)
        \Redis::incr($browser);
     }

    }



}