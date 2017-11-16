<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Area;

class AreasTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 * @return void
	 */
	public function run()
	{
		DB::table('areas')->delete();
		Area::create([
			'name' => "Humanidades",
			'prefix' => "HUMA",
			'description' => "Humanidades",
			'isPrinteable' => "Y",
			'order' => 7
		]);
		Area::create([
			'name' => "Matemáticas",
			'prefix' => "MATH",
			'description' => "Matemáticas",
			'isPrinteable' => "Y",
			'order' => 8,
		]);
		Area::create([
			'name' => "Ciencias Sociales, Hist, Geog, Const Pol y Democracia",
			'prefix' => "CS",
			'description' => "Ciencias Sociales, Hist, Geog, Const Pol y Democracia, Cívica y Urbanidad.",
			'isPrinteable' => "Y",
			'order' => 2,
		]);
		Area::create([
			'name' => "Ciencias Políticas",
			'prefix' => "CPCE",
			'description' => "Ciencias Políticas",
			'isPrinteable' => "Y",
			'order' => 10,
		]);
		Area::create([
			'name' => "Ciencias Económicas, Políticas",
			'prefix' => "CPCE",
			'description' => "Ciencias Económicas y Políticas",
			'isPrinteable' => "Y",
			'order' => 11,
		]);
		Area::create([
			'name' => "Filosofía",
			'prefix' => "FILO",
			'description' => "Filosofía",
			'isPrinteable' => "Y",
			'order' => 18,
		]);
		Area::create([
			'name' => "Educación Artística y Cultural",
			'prefix' => "EA",
			'description' => "Educación Artística y Cultural",
			'isPrinteable' => "Y",
			'order' => 3,
		]);
		Area::create([
			'name' => "Ciencias Naturales y Educación Ambiental",
			'prefix' => "CNEA",
			'description' => "Ciencias Naturales y Educación Ambiental",
			'isPrinteable' => "Y",
			'order' => 1,
		]);
		Area::create([
			'name' => "Emprendimiento y Empresarismo",
			'prefix' => "EMPR",
			'description' => "Emprendimiento y Empresarismo",
			'isPrinteable' => "Y",
			'order' => 16,
		]);
		Area::create([
			'name' => "Educación Física, Recreación y Deportes",
			'prefix' => "EDRD",
			'description' => "Educación Física, Recreación y Deporets",
			'isPrinteable' => "Y",
			'order' => 5,
		]);
		Area::create([
			'name' => "Educación Religiosa",
			'prefix' => "ER",
			'description' => "Educación Religiosa",
			'isPrinteable' => "Y",
			'order' => 6,
		]);
		Area::create([
			'name' => "Educación ética y en Valores Humanos",
			'prefix' => "EEVH",
			'description' => "Educación ética y en Valores Humanos",
			'isPrinteable' => "Y",
			'order' => 4,
		]);
		Area::create([
			'name' => "Dimensión Cognitiva",
			'prefix' => "DICG",
			'description' => "Dimensión Cognitiva",
			'isPrinteable' => "Y",
			'order' => 12,
		]);
		Area::create([
			'name' => "Dimensión Comunicativa",
			'prefix' => "DICO",
			'description' => "Dimensión Comunicativa",
			'isPrinteable' => "Y",
			'order' => 20,
		]);
		Area::create([
			'name' => "Dimensión Corporal",
			'prefix' => "DICP",
			'description' => "Dimensión Corporal",
			'isPrinteable' => "Y",
			'order' => 21,
		]);
		Area::create([
			'name' => "Dimensión Estética",
			'prefix' => "DIES",
			'description' => "Dimensión Estética",
			'isprinteable' => "Y",
			'order' => 23,
		]);
		Area::create([
			"name" => "Dimensión Socioafectiva Cívica y Urbanidad, Afrocolombianidad, Emprendimiento ",
			"prefix" => "DIAF",
			"description" => "Dimensión Socioafectiva Cívica y Urbanidad, Afrocolombianidad, Emprendimiento ",
			"isprinteable" => "Y",
			"order" => 22,
		]);
		Area::create([
			"name" => "Tecnología e Informática",
			"prefix" => "TeI",
			"description" => "Tecnología e Informática",
			"isprinteable" => "Y",
			"order" => 9,
		]);
		Area::create([
			"name" => "Convivencia",
			"prefix" => "CONV",
			"description" => "Convivencia",
			"isprinteable" => "Y",
			"order" => 13,
		]);
		Area::create([
			"name" => "Preescolar",
			"prefix" => "PREE",
			"description" => "Área de preescolar",
			"isprinteable" => "N",
			"order" => 14,
		]);
		Area::create([
			"name" => "Electivas",
			"prefix" => "ELEC",
			"description" => "Electivas",
			"isprinteable" => "Y",
			"order" => 17,
		]);
		Area::create([
			"name" => "Cívica y Urbanidad",
			"prefix" => "CIVI",
			"description" => "Cívica y Urbanidad",
			"isprinteable" => "Y",
			"order" => 18,
		]);
		Area::create([
			"name" => "Proyecto de Vida",
			"prefix" => "LIFE",
			"description" => "Proyecto de Vida",
			"isprinteable" => "Y",
			"order" => 19,
		]);
		Area::create([
			"name" =>"Dimensión Afectiva",
			"prefix" => "DIAF",
			"description" => "Dimensión Afectiva",
			"isprinteable" => "Y",
			"order" => 22,
		]);
		Area::create([
			"name" => "Dimensión Ética",
			"prefix" => "DIET",
			"description" => "Dimensión Ética",
			"isprinteable" => "Y",
			"order" => 23,
		]);
		Area::create([
			"name" => "Dimensión Actitudinal y Valorativa",
			"prefix" => "DIAC",
			"description" => "Dimensión Actitudinal y Valorativa",
			"isprinteable" => "Y",
			"order" => 24,
		]);
		Area::create([
			"name" => "Profundización",
			"prefix" => "PROF",
			"description" => "Profundización",
			"isprinteable" => "Y",
			"order" => 25,
		]);
		Area::create([
			"name" => "Acompañamiento de la Familia",
			"prefix" => "AFam",
			"description" => "Acompañamiento de la Familia",
			"isprinteable" => "N",
			"order" => 27,
		]);
	}
}
