<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Bloodtype;

class BloodtypesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('bloodtypes')->delete();
        Bloodtype::create(array('name' => ''));
        Bloodtype::create(array('name' => 'A+'));
        Bloodtype::create(array('name' => 'A-'));
        Bloodtype::create(array('name' => 'AB+'));
        Bloodtype::create(array('name' => 'AB-'));
        Bloodtype::create(array('name' => 'B+'));
        Bloodtype::create(array('name' => 'B-'));
        Bloodtype::create(array('name' => 'O+'));
        Bloodtype::create(array('name' => 'O-'));
    }

}
