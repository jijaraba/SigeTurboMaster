<?php

use Illuminate\Database\Seeder;

class EvaluationpurchasesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		DB::table('evaluationpurchases')->delete();
	}
}
