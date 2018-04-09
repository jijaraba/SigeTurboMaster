<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Stratus;

class StratusesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('stratuses')->delete();
        Stratus::create(array('name' => 'Estrato 01'));
        Stratus::create(array('name' => 'Estrato 02'));
        Stratus::create(array('name' => 'Estrato 03'));
        Stratus::create(array('name' => 'Estrato 04'));
        Stratus::create(array('name' => 'Estrato 05'));
        Stratus::create(array('name' => 'Estrato 06'));

    }

}