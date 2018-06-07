<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Paymenttype;

class PaymenttypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paymenttypes')->delete();
        Paymenttype::create(array('name' => 'Indefinido'));
        Paymenttype::create(array('name' => 'Matrícula'));
        Paymenttype::create(array('name' => 'Pensión'));
        Paymenttype::create(array('name' => 'Extracurricular'));
        Paymenttype::create(array('name' => 'Nivelaciones'));
        Paymenttype::create(array('name' => 'Validación'));
    }
}
