<?php

use Illuminate\Database\Seeder;

class QuantitativevalidationsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		DB::table('quantitativevalidations')->delete();
	}
}