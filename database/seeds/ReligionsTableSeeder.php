<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Religion;

class ReligionsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		DB::table('religions')->delete();
		Religion::create(array('name' => 'Ninguna'));
		Religion::create(array('name' => 'Católica'));
		Religion::create(array('name' => 'Cristiana'));
		Religion::create(array('name' => 'Budismo'));
		Religion::create(array('name' => 'Islam'));
		Religion::create(array('name' => 'Judaísmo'));
		Religion::create(array('name' => 'Hinduísmo'));
		Religion::create(array('name' => 'Agnóstico'));
		Religion::create(array('name' => 'Testigos de Jehová'));
		Religion::create(array('name' => 'Ortodoxo'));
	}

}