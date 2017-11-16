<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Provider;

class ProvidersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('providers')->delete();
        Provider::create([
            'name' => 'Ferrovisión S.A.S',
            'nit' => '900800700-01',
            'leadtime' => 2,
            'paymentform' => 15,
            'warranty' => 'Si',
            'evaluation' => 0.75,
            'date' => '2015-08-12',
        ]);
        Provider::create([
            'name' => 'Litografikaz S.A.S',
            'nit' => '900800701-01',
            'leadtime' => 8,
            'paymentform' => 15,
            'warranty' => 'Si',
            'evaluation' => 0.82,
            'date' => '2015-08-12',
        ]);
    }

}