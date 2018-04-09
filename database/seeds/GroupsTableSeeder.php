<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Group;

class GroupsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('groups')->delete();
        Group::create([
            'idgrade' => 1, 'name' => 'Párvulos A', 'order' => 1, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 1, 'name' => 'Párvulos B', 'order' => 2, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 2, 'name' => 'Pre-Jardín A', 'order' => 3, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 2, 'name' => 'Pre-Jardín B', 'order' => 4, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 3, 'name' => 'Jardín A', 'order' => 5, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 3, 'name' => 'Jardín B', 'order' => 6, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 4, 'name' => 'Transición A', 'order' => 7, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 4, 'name' => 'Transición B', 'order' => 8, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 5, 'name' => 'Pre-Primaria A', 'order' => 9, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 5, 'name' => 'Pre-Primaria B', 'order' => 10, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 6, 'name' => 'Primero A', 'order' => 11, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 6, 'name' => 'Primero B', 'order' => 12, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 7, 'name' => 'Segundo A', 'order' => 13, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 7, 'name' => 'Segundo B', 'order' => 14, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 8, 'name' => 'Tercero A', 'order' => 15, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 8, 'name' => 'Tercero B', 'order' => 16, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 9, 'name' => 'Cuarto A', 'order' => 17, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 9, 'name' => 'Cuarto B', 'order' => 18, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 10, 'name' => 'Quinto A', 'order' => 19, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 10, 'name' => 'Quinto B', 'order' => 20, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 11, 'name' => 'Sexto A', 'order' => 21, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 11, 'name' => 'Sexto B', 'order' => 22, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 12, 'name' => 'Séptimo A', 'order' => 23, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 12, 'name' => 'Séptimo B', 'order' => 24, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 13, 'name' => 'Octavo A', 'order' => 25, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 13, 'name' => 'Octavo B', 'order' => 26, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 14, 'name' => 'Noveno A', 'order' => 27, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 14, 'name' => 'Noveno B', 'order' => 28, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 15, 'name' => 'Décimo A', 'order' => 29, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 15, 'name' => 'Décimo B', 'order' => 30, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 16, 'name' => 'Undécimo A', 'order' => 31, 'active' => 'Y'
        ]);
        Group::create([
            'idgrade' => 16, 'name' => 'Undécimo B', 'order' => 32, 'active' => 'Y'
        ]);
    }
}