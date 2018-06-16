<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Bank;

class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banks')->delete();
        Bank::create(array('name' => 'Virtual AV', 'idaccounttype' => 3, 'idcostcenter' => 1));
        Bank::create(array('name' => 'Tesorería', 'idaccounttype' => 1, 'idcostcenter' => 1));
        Bank::create(array('name' => 'AVVillas', 'idaccounttype' => 3, 'idcostcenter' => 1));
        Bank::create(array('name' => 'BBVA AHO', 'idaccounttype' => 4, 'idcostcenter' => 1));
        Bank::create(array('name' => 'BBVA CTE', 'idaccounttype' => 2, 'idcostcenter' => 1));
        Bank::create(array('name' => 'ANTICIPO', 'idaccounttype' => 19, 'idcostcenter' => 1));
    }
}
