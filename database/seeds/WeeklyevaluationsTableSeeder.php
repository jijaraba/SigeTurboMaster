<?php

use Illuminate\Database\Seeder;

class WeeklyevaluationsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		DB::table('weeklyevaluations')->delete();

	}

}
