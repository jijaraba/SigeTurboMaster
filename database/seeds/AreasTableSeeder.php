<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Area;

class AreasTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('areas')->delete();
        Area::create([
            'name' => "Humanidades",
            'shortname' => "Humanidades",
            'prefix' => "HUMA",
            'description' => "Humanidades",
            'isPrinteable' => "Y",
            'order' => 7
        ]);
        Area::create([
            'name' => "Matemáticas",
            'shortname' => "Matemáticas",
            'prefix' => "MATH",
            'description' => "Matemáticas",
            'isPrinteable' => "Y",
            'order' => 8,
        ]);
        Area::create([
            'name' => "Ciencias Sociales, Hist, Geog, Const Pol y Democracia",
            'shortname' => "Ciencias Sociales",
            'prefix' => "CS",
            'description' => "Ciencias Sociales, Hist, Geog, Const Pol y Democracia, Cívica y Urbanidad.",
            'isPrinteable' => "Y",
            'order' => 2,
        ]);
        Area::create([
            'name' => "Ciencias Políticas",
            'shortname' => "Ciencias Políticas",
            'prefix' => "CPCE",
            'description' => "Ciencias Políticas",
            'isPrinteable' => "Y",
            'order' => 10,
        ]);
        Area::create([
            'name' => "Ciencias Económicas, Políticas",
            'shortname' => "Ciencias Económicas",
            'prefix' => "CPCE",
            'description' => "Ciencias Económicas y Políticas",
            'isPrinteable' => "Y",
            'order' => 11,
        ]);
        Area::create([
            'name' => "Filosofía",
            'shortname' => "Filosofía",
            'prefix' => "FILO",
            'description' => "Filosofía",
            'isPrinteable' => "Y",
            'order' => 18,
        ]);
        Area::create([
            'name' => "Educación Artística y Cultural",
            'shortname' => "Educación Artística",
            'prefix' => "EA",
            'description' => "Educación Artística y Cultural",
            'isPrinteable' => "Y",
            'order' => 3,
        ]);
        Area::create([
            'name' => "Ciencias Naturales y Educación Ambiental",
            'shortname' => "Ciencias Naturales",
            'prefix' => "CNEA",
            'description' => "Ciencias Naturales y Educación Ambiental",
            'isPrinteable' => "Y",
            'order' => 1,
        ]);
        Area::create([
            'name' => "Emprendimiento y Empresarismo",
            'shortname' => "Emprendimiento",
            'prefix' => "EMPR",
            'description' => "Emprendimiento y Empresarismo",
            'isPrinteable' => "Y",
            'order' => 16,
        ]);
        Area::create([
            'name' => "Educación Física, Recreación y Deportes",
            'shortname' => "Educación Física",
            'prefix' => "EDRD",
            'description' => "Educación Física, Recreación y Deporets",
            'isPrinteable' => "Y",
            'order' => 5,
        ]);
        Area::create([
            'name' => "Educación Religiosa",
            'shortname' => "Educación Religiosa",
            'prefix' => "ER",
            'description' => "Educación Religiosa",
            'isPrinteable' => "Y",
            'order' => 6,
        ]);
        Area::create([
            'name' => "Educación ética y en Valores Humanos",
            'shortname' => "Educación Ética",
            'prefix' => "EEVH",
            'description' => "Educación ética y en Valores Humanos",
            'isPrinteable' => "Y",
            'order' => 4,
        ]);
        Area::create([
            'name' => "Dimensión Cognitiva",
            'shortname' => "Dimensión Cognitiva",
            'prefix' => "DICG",
            'description' => "Dimensión Cognitiva",
            'isPrinteable' => "Y",
            'order' => 12,
        ]);
        Area::create([
            'name' => "Dimensión Comunicativa",
            'shortname' => "Dimensión Comunicativa",
            'prefix' => "DICO",
            'description' => "Dimensión Comunicativa",
            'isPrinteable' => "Y",
            'order' => 20,
        ]);
        Area::create([
            'name' => "Dimensión Corporal",
            'shortname' => "Dimensión Corporal",
            'prefix' => "DICO",
            'description' => "Dimensión Corporal",
            'isPrinteable' => "Y",
            'order' => 21,
        ]);
        Area::create([
            'name' => "Dimensión Estética",
            'shortname' => "Dimensión Estética",
            'prefix' => "DIES",
            'description' => "Dimensión Estética",
            'isprinteable' => "Y",
            'order' => 23,
        ]);
        Area::create([
            "name" => "Dimensión Socioafectiva Cívica y Urbanidad, Afrocolombianidad, Emprendimiento ",
            "shortname" => "Dimensión Socioafectiva",
            "prefix" => "DIAF",
            "description" => "Dimensión Socioafectiva Cívica y Urbanidad, Afrocolombianidad, Emprendimiento ",
            "isprinteable" => "Y",
            "order" => 22,
        ]);
        Area::create([
            "name" => "Tecnología e Informática",
            "shortname" => "Tecnología e Informática",
            "prefix" => "TeI",
            "description" => "Tecnología e Informática",
            "isprinteable" => "Y",
            "order" => 9,
        ]);
        Area::create([
            "name" => "Convivencia",
            "shortname" => "Convivencia",
            "prefix" => "CONV",
            "description" => "Convivencia",
            "isprinteable" => "Y",
            "order" => 13,
        ]);
        Area::create([
            "name" => "Preescolar",
            "shortname" => "Preescolar",
            "prefix" => "PREE",
            "description" => "Área de preescolar",
            "isprinteable" => "N",
            "order" => 14,
        ]);
        Area::create([
            "name" => "Electivas",
            "shortname" => "Electivas",
            "prefix" => "ELEC",
            "description" => "Electivas",
            "isprinteable" => "Y",
            "order" => 17,
        ]);
        Area::create([
            "name" => "Cívica y Urbanidad",
            "shortname" => "Cívica y Urbanidad",
            "prefix" => "CIVI",
            "description" => "Cívica y Urbanidad",
            "isprinteable" => "Y",
            "order" => 18,
        ]);
        Area::create([
            "name" => "Proyecto de Vida",
            "shortname" => "Proyecto de Vida",
            "prefix" => "LIFE",
            "description" => "Proyecto de Vida",
            "isprinteable" => "Y",
            "order" => 19,
        ]);
        Area::create([
            "name" => "Dimensión Afectiva",
            "shortname" => "Dimensión Afectiva",
            "prefix" => "DIAF",
            "description" => "Dimensión Afectiva",
            "isprinteable" => "Y",
            "order" => 22,
        ]);
        Area::create([
            "name" => "Dimensión Ética",
            "shortname" => "Dimensión Ética",
            "prefix" => "DIET",
            "description" => "Dimensión Ética",
            "isprinteable" => "Y",
            "order" => 23,
        ]);
        Area::create([
            "name" => "Dimensión Actitudinal y Valorativa",
            "shortname" => "Dimensión Actitudinal",
            "prefix" => "DIAC",
            "description" => "Dimensión Actitudinal y Valorativa",
            "isprinteable" => "Y",
            "order" => 24,
        ]);
        Area::create([
            "name" => "Profundización",
            "shortname" => "Profundización",
            "prefix" => "PROF",
            "description" => "Profundización",
            "isprinteable" => "Y",
            "order" => 25,
        ]);
        Area::create([
            "name" => "Acompañamiento de la Familia",
            "shortname" => "Acompañamiento",
            "prefix" => "AFam",
            "description" => "Acompañamiento de la Familia",
            "isprinteable" => "N",
            "order" => 27,
        ]);
    }
}
