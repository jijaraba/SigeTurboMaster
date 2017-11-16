<?php

use Illuminate\Database\Seeder;

class QuantitativerecoveriesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('quantitativerecoveries')->delete();
    }
}