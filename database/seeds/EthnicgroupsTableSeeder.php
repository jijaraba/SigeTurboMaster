<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Ethnicgroup;

class EthnicgroupsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		DB::table('ethnicgroups')->delete();
		Ethnicgroup::create(array('name' => 'Blanco'));
		Ethnicgroup::create(array('name' => 'Negro'));
		Ethnicgroup::create(array('name' => 'Mestizo'));
		Ethnicgroup::create(array('name' => 'Mulato'));
		Ethnicgroup::create(array('name' => 'Indígena'));
	}

}