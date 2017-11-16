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
        Bank::create(array('name' => ''));
        Bank::create(array('name' => 'Tesorería'));
        Bank::create(array('name' => 'AVVillas'));
        Bank::create(array('name' => 'BBVA'));
    }
}
