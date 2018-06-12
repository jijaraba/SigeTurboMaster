<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Vouchertype;

class VouchertypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vouchertypes')->delete();
        Vouchertype::create(array('name' => 'RECIBO VIRTUAL', 'code' => '00001'));
        Vouchertype::create(array('name' => 'RECIBO MANUAL', 'code' => '00002'));
        Vouchertype::create(array('name' => 'VENTAS', 'code' => '00008'));
        Vouchertype::create(array('name' => 'ANTICIPO', 'code' => '00010'));
    }
}
