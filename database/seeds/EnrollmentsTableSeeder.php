<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Enrollment;

class EnrollmentsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('enrollments')->delete();
        Enrollment::create(array('idyear' => 2017, 'idgroup' => 31, 'iduser' => 2017001, 'idstatusschooltype' => 1, 'register' => '2017-08-01', 'reentry' => 'Y', 'scholarship' => 0.00, 'inclusion' => 'Y'));
        Enrollment::create(array('idyear' => 2017, 'idgroup' => 29, 'iduser' => 2017002, 'idstatusschooltype' => 1, 'register' => '2017-08-01', 'reentry' => 'Y', 'scholarship' => 0.20, 'inclusion' => 'Y'));
    }

}