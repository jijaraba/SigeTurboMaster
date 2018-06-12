<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Transactiontype;

class TransactiontypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transactiontypes')->delete();
        Transactiontype::create(array('name' => 'DÉBITO', 'prefix' => '1'));
        Transactiontype::create(array('name' => 'CRÉDITO', 'prefix' => '2'));
    }
}
