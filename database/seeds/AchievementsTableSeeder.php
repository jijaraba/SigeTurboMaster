<?php

use Illuminate\Database\Seeder;

class AchievementsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('achievements')->delete();
    }

}
