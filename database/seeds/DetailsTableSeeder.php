<?php

use Illuminate\Database\Seeder;

class DetailsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('details')->delete();
    }
}
