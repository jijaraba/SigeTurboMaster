<?php

use Illuminate\Database\Seeder;

class TimeintensitiesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('timeintensities')->delete();
    }
}