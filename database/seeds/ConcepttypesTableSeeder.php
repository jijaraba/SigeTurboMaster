<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Concepttype;

class ConcepttypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounttypes')->delete();
        Concepttype::create(array('name' => 'Matrícula','prefix'=>'enrollment'));
        Concepttype::create(array('name' => 'Pensión','prefix'=>'pension'));
        Concepttype::create(array('name' => 'Nivelación','prefix'=>'nivelation'));
        Concepttype::create(array('name' => 'Extracurricular','prefix'=>'nivelation'));
    }
}
