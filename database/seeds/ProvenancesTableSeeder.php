<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Provenance;

class ProvenancesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('provenances')->delete();
        Provenance::create(['name' => 'Interna']);
        Provenance::create(['name' => 'Externa']);
    }
}