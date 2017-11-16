<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Language;

class LanguagesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('languages')->delete();
        Language::create([
            'name' => 'Español',
        ]);
        Language::create([
            'name' => 'Inglés',
        ]);
        Language::create([
            'name' => 'Italiano',
        ]);
        Language::create([
            'name' => 'Francés',
        ]);
        Language::create([
            'name' => 'Portugues',
        ]);
    }
}