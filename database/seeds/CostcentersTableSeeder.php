<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Costcenter;

class CostcentersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('costcenters')->delete();
        Costcenter::create(array('name' => '', 'code' => ''));
        Costcenter::create(array('name' => 'PREESCOLAR', 'code' => '10'));
        Costcenter::create(array('name' => 'PRIMARIA', 'code' => '20'));
        Costcenter::create(array('name' => 'BÁSICA', 'code' => '30'));
        Costcenter::create(array('name' => 'MEDIA', 'code' => '40'));
    }
}
