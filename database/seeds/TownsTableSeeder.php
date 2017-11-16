<?php

use Illuminate\Database\Seeder;

class TownsTableSeeder extends Seeder {

	/**
	 * Run the migrations.
	 * @return void
	 */
	public function run()
	{
		DB::table('towns')->delete();
		DB::unprepared(file_get_contents('dummies/sql/towns.sql'));
	}
}