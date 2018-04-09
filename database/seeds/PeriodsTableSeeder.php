<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Period;

class PeriodsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('periods')->delete();
        Period::create(['name' => 'Primer Periodo', 'prefix' => 1]);
        Period::create(['name' => 'Segundo Periodo', 'prefix' => 2]);
        Period::create(['name' => 'Tercer Periodo', 'prefix' => 3]);
        Period::create(['name' => 'Cuarto Periodo', 'prefix' => 4]);
    }
}