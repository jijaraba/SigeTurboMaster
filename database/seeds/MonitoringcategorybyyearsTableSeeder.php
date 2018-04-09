<?php

use Illuminate\Database\Seeder;

class MonitoringcategorybyyearsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('monitoringcategorybyyears')->delete();
    }

}