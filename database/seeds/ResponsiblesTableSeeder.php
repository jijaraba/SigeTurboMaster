<?php

use Illuminate\Database\Seeder;

class ResponsiblesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('responsibles')->delete();
    }
}