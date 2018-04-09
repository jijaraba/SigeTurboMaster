<?php

use Illuminate\Database\Seeder;

class QualitativeratingfinalareasTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('qualitativeratingfinalareas')->delete();
    }

}