<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Grade;

class GradesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('grades')->delete();
        Grade::create([
            'name' => 'Párvulos', 'prefix' => 'TLD', 'active' => 'Y', 'order' => 1
        ]);
        Grade::create([
            'name' => 'Pre-Jardín', 'prefix' => 'PKD', 'active' => 'Y', 'order' => 2
        ]);
        Grade::create([
            'name' => 'Jardín', 'prefix' => 'KDN', 'active' => 'Y', 'order' => 3
        ]);
        Grade::create([
            'name' => 'Transición', 'prefix' => 'TSC', 'active' => 'Y', 'order' => 4
        ]);
        Grade::create([
            'name' => 'Pre-Primaria', 'prefix' => 'PPR', 'active' => 'Y', 'order' => 5
        ]);
        Grade::create([
            'name' => 'Primero', 'prefix' => 'PRO', 'active' => 'Y', 'order' => 6
        ]);
        Grade::create([
            'name' => 'Segundo', 'prefix' => 'SEG', 'active' => 'Y', 'order' => 7
        ]);
        Grade::create([
            'name' => 'Tercero', 'prefix' => 'TCR', 'active' => 'Y', 'order' => 8
        ]);
        Grade::create([
            'name' => 'Cuarto', 'prefix' => 'CUA', 'active' => 'Y', 'order' => 9
        ]);
        Grade::create([
            'name' => 'Quinto', 'prefix' => 'QUI', 'active' => 'Y', 'order' => 10
        ]);
        Grade::create([
            'name' => 'Sexto', 'prefix' => 'SEX', 'active' => 'Y', 'order' => 11
        ]);
        Grade::create([
            'name' => 'Séptimo', 'prefix' => 'SEP', 'active' => 'Y', 'order' => 12
        ]);
        Grade::create([
            'name' => 'Octavo', 'prefix' => 'OCT', 'active' => 'Y', 'order' => 13
        ]);
        Grade::create([
            'name' => 'Noveno', 'prefix' => 'NOV', 'active' => 'Y', 'order' => 14
        ]);
        Grade::create([
            'name' => 'Décimo', 'prefix' => 'DEC', 'active' => 'Y', 'order' => 15
        ]);
        Grade::create([
            'name' => 'Undécimo', 'prefix' => 'UND', 'active' => 'Y', 'order' => 16
        ]);
    }
}