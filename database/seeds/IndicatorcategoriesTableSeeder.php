<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Indicatorcategory;

class IndicatorcategoriesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		DB::table('indicatorcategories')->delete();
		Indicatorcategory::create(array('name' => 'Normal'));
		Indicatorcategory::create(array('name' => 'Flexibilización'));
	}
}