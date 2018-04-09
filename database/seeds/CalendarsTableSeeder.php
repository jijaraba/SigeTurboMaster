<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Calendar;

class CalendarsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('calendars')->delete();
        Calendar::create(array('name' => 'Calendario A'));
        Calendar::create(array('name' => 'Calendario B'));
        Calendar::create(array('name' => 'Calendario C'));
    }

}
