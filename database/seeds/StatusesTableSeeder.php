<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Status;

class StatusesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->delete();
        Status::create(array('name' => 'Activo'));
        Status::create(array('name' => 'Bloqueado'));
        Status::create(array('name' => 'Suspendido'));
        Status::create(array('name' => 'Retirado'));
        Status::create(array('name' => 'Pendiente'));
        Status::create(array('name' => 'Pasantía'));
        Status::create(array('name' => 'Firma'));
        Status::create(array('name' => 'Desertor'));
        Status::create(array('name' => 'Pasantía Retirada'));
        Status::create(array('name' => 'Promovido'));
        Status::create(array('name' => 'Asistente'));
        Status::create(array('name' => 'Pendiente Promoción'));
    }

}