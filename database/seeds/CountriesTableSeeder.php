<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('countries')->delete();
        DB::unprepared(file_get_contents('dummies/sql/countries.sql'));
    }
}