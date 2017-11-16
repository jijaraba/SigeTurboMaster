<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Indicatortype;

class IndicatortypesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		DB::table('indicatortypes')->delete();
		Indicatortype::create(array('name' => 'Fortaleza'));
		Indicatortype::create(array('name' => 'Recomendación'));
	}

}