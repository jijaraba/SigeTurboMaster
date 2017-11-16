<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Maritalstatus;

class MaritalstatusesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		DB::table('maritalstatuses')->delete();
		Maritalstatus::create(array('name' => ''));
		Maritalstatus::create(array('name' => 'Soltero'));
		Maritalstatus::create(array('name' => 'Casado'));
		Maritalstatus::create(array('name' => 'Viudo'));
		Maritalstatus::create(array('name' => 'Separado'));
		Maritalstatus::create(array('name' => 'Unión Libre'));
		Maritalstatus::create(array('name' => 'Fallecido'));
	}

}