<?php

use Illuminate\Database\Seeder;

class AcademicsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('academics')->delete();
    }

}
