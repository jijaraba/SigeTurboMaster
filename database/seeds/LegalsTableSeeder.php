<?php

use Illuminate\Database\Seeder;

class LegalsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('legals')->delete();
    }

}