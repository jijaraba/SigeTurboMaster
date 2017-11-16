<?php

use Illuminate\Database\Seeder;

class TaskfilesTableSeeder extends Seeder
{

	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{

		DB::table('taskfiles')->delete();

	}

}