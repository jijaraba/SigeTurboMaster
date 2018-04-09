<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Gender;

class GendersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('genders')->delete();
        Gender::create(array('name' => 'Masculino'));
        Gender::create(array('name' => 'Femenino'));
    }

}