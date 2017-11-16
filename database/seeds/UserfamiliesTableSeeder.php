<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Userfamily;

class UserfamiliesTableSeeder extends Seeder {

    /**
     * Run the migrations.
     * @return void
     */
    public function run()
    {
        DB::table('userfamilies')->delete();
        Userfamily::create(array('iduser' => 99999996,'idfamily' => 1));
        Userfamily::create(array('iduser' => 99999997,'idfamily' => 1));
        Userfamily::create(array('iduser' => 99999998,'idfamily' => 1));
    }
}