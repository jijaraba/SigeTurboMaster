<?php


use Illuminate\Database\Seeder;
use SigeTurbo\Product;

class ProductsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     * @return void
     */
	public function run()
	{
        DB::table('products')->delete();
        Product::create([
            'idproductcategory' => 1,
            'code' => 8080001,
            'name' => 'Toallas de Baño',
            'vat' => 0.16,
            'unit' => 'Unidad',
        ]);
        Product::create([
            'idproductcategory' => 1,
            'code' => 8080002,
            'name' => 'Papel Higiénico',
            'vat' => 0.16,
            'unit' => 'Unidad',
        ]);
        Product::create([
            'idproductcategory' => 2,
            'code' => 8081001,
            'name' => 'Equipo Portátil: HP V230',
            'vat' => 0.0,
            'unit' => 'Unidad',
        ]);
        Product::create([
            'idproductcategory' => 3,
            'code' => 8082001,
            'name' => 'Cemento Gris',
            'vat' => 0.16,
            'unit' => 'Unidad',
        ]);
	}

}