<?php

use Illuminate\Database\Seeder;

class MonitoringtypesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		DB::table('monitoringtypes')->delete();
	}

}