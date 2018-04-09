<?php


use Illuminate\Database\Seeder;
use SigeTurbo\Productcategory;

class ProductcategoriesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('productcategories')->delete();
        Productcategory::create([
            'name' => 'Aseo y Limpieza',
        ]);
        Productcategory::create([
            'name' => 'Inversiones: Equipo de Cómputo',
        ]);
        Productcategory::create([
            'name' => 'Mantenimiento',
        ]);
    }

}