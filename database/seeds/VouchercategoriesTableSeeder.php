<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Vouchercategory;

class VouchercategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('vouchercategories')->delete();
        Vouchercategory::create(array('name' => 'Venta'));
        Vouchercategory::create(array('name' => 'Recibo'));
    }
}
