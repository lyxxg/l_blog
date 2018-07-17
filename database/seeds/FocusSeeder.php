<?php

use Illuminate\Database\Seeder;

class FocusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=6;$i++) {
            \Illuminate\Support\Facades\DB::table("focus")->insert([
           'ico'=>'futrue/qm/0'.$i.'.jpg',
            'title'=>'title'.$i,
            'href'=>'#'.$i

            ]);
        }
    }
}
