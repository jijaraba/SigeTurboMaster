<?php

use Illuminate\Database\Seeder;

class NotificationusersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('notificationusers')->delete();
    }
}