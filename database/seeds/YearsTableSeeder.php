<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Year;

class YearsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('years')->delete();
        Year::create(
            [
                'idyear' => '2016',
                'idcalendar' => 2,
                'name' => '2016-2017',
                'prefix' => '2016',
                'starts' => '2016-08-01',
                'ends' => '2017-07-31'
            ]
        );
        Year::create(
            [
                'idyear' => '2017',
                'idcalendar' => 2,
                'name' => '2017-2018',
                'prefix' => '2017',
                'starts' => '2017-08-01',
                'ends' => '2018-07-31'
            ]
        );

    }

}
