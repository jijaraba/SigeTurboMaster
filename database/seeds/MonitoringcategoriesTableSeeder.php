<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Monitoringcategory;

class MonitoringcategoriesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('monitoringcategories')->delete();
        Monitoringcategory::create(array('name' => 'Seguimiento'));
        Monitoringcategory::create(array('name' => 'Evaluación'));
        Monitoringcategory::create(array('name' => 'Prueba'));
        Monitoringcategory::create(array('name' => 'Cuaderno'));
        Monitoringcategory::create(array('name' => 'Guía Aprendizaje'));
    }

}