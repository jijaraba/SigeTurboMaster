<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Visitortype;

class VisitortypesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('visitortypes')->delete();
        Visitortype::create([
            'name' => 'Proveedor',
        ]);
        Visitortype::create([
            'name' => 'Familia',
        ]);
        Visitortype::create([
            'name' => 'Entrevista',
        ]);
    }
}