<?php

use Illuminate\Database\Seeder;

class QuantitativerecoveryfinalsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('quantitativerecoveryfinals')->delete();
    }
}