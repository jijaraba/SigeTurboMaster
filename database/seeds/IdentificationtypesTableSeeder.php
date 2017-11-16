<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Identificationtype;

class IdentificationtypesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('identificationtypes')->delete();
        Identificationtype::create([
            'name' => 'Registro Civil'
        ]);
        Identificationtype::create([
            'name' => 'Tarjeta de Identidad'
        ]);
        Identificationtype::create([
            'name' => 'Cédula'
        ]);
        Identificationtype::create([
            'name' => 'Pasaporte Nacional'
        ]);
        Identificationtype::create([
            'name' => 'Pasaporte Exranjero'
        ]);
        Identificationtype::create([
            'name' => 'Visa'
        ]);
        Identificationtype::create([
            'name' => 'NUIP'
        ]);
        Identificationtype::create([
            'name' => 'Carné de Identificación Diplomática'
        ]);
        Identificationtype::create([
            'name' => 'Cédula de Extranjería'
        ]);
        Identificationtype::create([
            'name' => 'NIT'
        ]);
    }

}