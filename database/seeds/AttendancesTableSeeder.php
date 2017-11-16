<?php

use Illuminate\Database\Seeder;

class AttendancesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('attendances')->delete();
    }

}
