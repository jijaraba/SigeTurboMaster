<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Indicatorcategory;

class IndicatorcategoriesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('indicatorcategories')->delete();
        Indicatorcategory::create(array('name' => 'General', 'prefix' => 1));
        Indicatorcategory::create(array('name' => 'Flexibilización', 'prefix' => 2));
        Indicatorcategory::create(array('name' => 'Profundización', 'prefix' => 3));
    }
}