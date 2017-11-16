<?php

use Illuminate\Database\Seeder;

class QuantitativerecoveryfinalareasTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		DB::table('quantitativerecoveryfinalareas')->delete();
	}
}