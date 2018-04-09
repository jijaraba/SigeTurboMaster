<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('departments')->delete();
        DB::unprepared(file_get_contents('dummies/sql/departments.sql'));
    }
}