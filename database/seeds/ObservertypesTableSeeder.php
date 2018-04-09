<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Observertype;

class ObservertypesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('observertypes')->delete();
        Observertype::create([
            'name' => 'Comportamiento Social'
        ]);
        Observertype::create([
            'name' => 'Comunicación Efectiva'
        ]);
        Observertype::create([
            'name' => 'Seguimiento'
        ]);
        Observertype::create([
            'name' => 'Orientación y Bienestar'
        ]);
        Observertype::create([
            'name' => 'Observador'
        ]);
        Observertype::create([
            'name' => 'Flexibilización'
        ]);
        Observertype::create([
            'name' => 'Adecuación'
        ]);
        Observertype::create([
            'name' => 'Profundización'
        ]);
        Observertype::create([
            'name' => 'Inclusión'
        ]);
    }
}