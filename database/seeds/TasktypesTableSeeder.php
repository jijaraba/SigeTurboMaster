<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Tasktype;

class TasktypesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {

        DB::table('tasktypes')->delete();
        Tasktype::create([
            "idtasktype" => 1,
            "name" => 'Tarea',
        ]);
        Tasktype::create([
            "idtasktype" => 2,
            "name" => 'Plan de Apoyo',
        ]);
        Tasktype::create([
            "idtasktype" => 3,
            "name" => 'Exámenes',
        ]);

    }

}