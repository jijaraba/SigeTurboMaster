<?php

use Illuminate\Database\Seeder;

class GroupdirectorsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('groupdirectors')->delete();
    }

}