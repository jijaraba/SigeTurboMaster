<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Statusschooltype;

class StatusschooltypesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('statusschooltypes')->delete();
        Statusschooltype::create(array('name' => 'Activo', 'duration' => 0));
        Statusschooltype::create(array('name' => 'Bloqueado', 'duration' => 2));
        Statusschooltype::create(array('name' => 'Suspendido', 'duration' => 8));
        Statusschooltype::create(array('name' => 'Retirado', 'duration' => 0));
        Statusschooltype::create(array('name' => 'Pendiente', 'duration' => 8));
        Statusschooltype::create(array('name' => 'Pasantía', 'duration' => 8));
        Statusschooltype::create(array('name' => 'Pendiente Retirado', 'duration' => NULL));
        Statusschooltype::create(array('name' => 'Desertor', 'duration' => 0));
        Statusschooltype::create(array('name' => 'Pasantía Retirada', 'duration' => NULL));
        Statusschooltype::create(array('name' => 'Promovido', 'duration' => 0));
        Statusschooltype::create(array('name' => 'Asistente', 'duration' => 0));
        Statusschooltype::create(array('name' => 'Pendiente Promoción', 'duration' => 0));
    }

}