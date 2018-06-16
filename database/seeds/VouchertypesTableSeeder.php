<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Vouchertype;

class VouchertypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('vouchertypes')->delete();
        Vouchertype::create(array('idvouchercategory' => 2, 'name' => 'RECIBO VIRTUAL', 'code' => '00001'));
        Vouchertype::create(array('idvouchercategory' => 2, 'name' => 'RECIBO MANUAL', 'code' => '00002'));
        Vouchertype::create(array('idvouchercategory' => 1, 'name' => 'VENTAS', 'code' => '00008'));
        Vouchertype::create(array('idvouchercategory' => 1, 'name' => 'ANTICIPO', 'code' => '00010'));
    }
}
