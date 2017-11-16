<?php

use Illuminate\Database\Seeder;

class MonitoringtypeindicatorsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		DB::table('monitoringtypeindicators')->delete();
	}

}