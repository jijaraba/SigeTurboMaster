<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Family;

class FamiliesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('families')->delete();
        Family::create(array('name' => 'FooBar Bar'));
    }

}