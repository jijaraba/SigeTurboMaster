<?php

use Illuminate\Database\Seeder;

class TypeofpromotionsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('typeofpromotions')->delete();
    }
}