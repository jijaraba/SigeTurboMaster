<?php

use Illuminate\Database\Seeder;

class PartialratingsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		DB::table('partialratings')->delete();
	}
}