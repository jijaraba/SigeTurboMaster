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
        Package::create(array('idconcepttype' => 1, 'code' => 1101, 'name' => 'Indefinido'));
        Package::create(array('idconcepttype' => 2, 'code' => 1102, 'name' => 'Matrícula Estudiantes Nuevos al 100%'));
        Package::create(array('idconcepttype' => 2, 'code' => 1103, 'name' => 'Matrícula Estudiantes Nuevos al 100% (ANTICIPO)'));
        Package::create(array('idconcepttype' => 2, 'code' => 1104, 'name' => 'Matrícula Estudiantes Antiguos al 100%'));
        Package::create(array('idconcepttype' => 2, 'code' => 1105, 'name' => 'Matrícula Estudiantes Antiguos al 100% (ANTICIPO)'));
        Package::create(array('idconcepttype' => 3, 'code' => 1106, 'name' => 'Pensión al 100%'));
        Package::create(array('idconcepttype' => 3, 'code' => 1107, 'name' => 'Pensión al 100% (ANTICIPO)'));
    }
}
