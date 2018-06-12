<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Voucherconsecutive;

class VoucherconsecutivesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('voucherconsecutives')->delete();
        Voucherconsecutive::create(array('idvouchertype' => 1, 'documenttype' => 'virtual_receipt', 'consecutive' => 100));
        Voucherconsecutive::create(array('idvouchertype' => 2, 'documenttype' => 'cash_receipt', 'consecutive' => 200));
        Voucherconsecutive::create(array('idvouchertype' => 3, 'documenttype' => 'invoice', 'consecutive' => 300));
        Voucherconsecutive::create(array('idvouchertype' => 4, 'documenttype' => 'advance', 'consecutive' => 400));
    }
}
