<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Package;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->delete();
        Package::create(array('idconcepttype' => 1, 'code' => 1000, 'name' => 'Indefinido'));
        Package::create(array('idconcepttype' => 2, 'code' => 2000, 'name' => 'Cobro de Matrícula al 100%'));
        Package::create(array('idconcepttype' => 3, 'code' => 3000, 'name' => 'Cobro de Pensión al 100%'));
    }
}
