<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use SigeTurbo\Areamanager;

class AreamanagersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('areamanagers')->delete();
        Areamanager::create([
            'idyear' => 2015,
            'idarea' => 1,
            'iduser' => 99999997,
        ]);
        Areamanager::create([
            'idyear' => 2015,
            'idarea' => 2,
            'iduser' => 99999997,
        ]);
    }
}
