<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Enrollment;

class EnrollmentsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		DB::table('enrollments')->delete();
		Enrollment::create(array('idyear' => 2015, 'idgroup' => 31, 'iduser' => 99999996, 'idstatusschooltype' => 1, 'register' => '2016-03-12', 'reentry' => 'Y', 'scholarship' =>0.00,'inclusion'=>'Y'));
		Enrollment::create(array('idyear' => 2014, 'idgroup' => 29, 'iduser' => 99999996, 'idstatusschooltype' => 1, 'register' => '2015-03-12', 'reentry' => 'Y', 'scholarship' =>0.00,'inclusion'=>'Y'));
	}

}