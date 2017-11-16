<?php

use Illuminate\Database\Seeder;

class DescriptivereportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('descriptivereports')->delete();
    }
}
