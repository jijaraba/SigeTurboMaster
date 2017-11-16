<?php

use Illuminate\Database\Seeder;

class PreregistrationsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('preregistrations')->delete();
    }
}