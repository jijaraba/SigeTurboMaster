<?php

use Illuminate\Database\Seeder;

class AclsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('acls')->delete();
        DB::unprepared(file_get_contents('dummies/sql/acls.sql'));
    }

}
