<?php

use Illuminate\Database\Seeder;

class QualitativerecoveryfinalareasTableSeeder extends Seeder
{

	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		DB::table('qualitativerecoveryfinalareas')->delete();
	}

}