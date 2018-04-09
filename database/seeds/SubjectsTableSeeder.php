<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Subject;

class SubjectsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {

        DB::table('subjects')->delete();
        Subject::create([
            "idsubject" => 1,
            "idarea" => 1,
            "name" => "Lengua Castellana",
            "shortname" => "Lengua Castellana",
            "prefix" => "spanish",
        ]);
        Subject::create([
            "idsubject" => 2,
            "idarea" => 1,
            "name" => "Lengua Extranjera: Inglés L.A",
            "shortname" => "Inglés",
            "prefix" => "ingl",
        ]);
        Subject::create([
            "idsubject" => 4,
            "idarea" => 2,
            "name" => "Matemáticas",
            "shortname" => "Matemáticas",
            "prefix" => "math",
        ]);
        Subject::create([
            "idsubject" => 5,
            "idarea" => 3,
            "name" => "Ciencias Sociales en Lengua Castellana",
            "shortname" => "Ciencias Sociales",
            "prefix" => "soco",
        ]);
        Subject::create([
            "idsubject" => 6,
            "idarea" => 3,
            "name" => "Ciencias Sociales, Hist, Geog, Const Pol y Democracia.",
            "shortname" => "Ciencias Sociales",
            "prefix" => "scst",
        ]);
        Subject::create([
            "idsubject" => 7,
            "idarea" => 3,
            "name" => "Ciencias Sociales, Hist, Geog, Const Pol y Demo.",
            "shortname" => "Ciencias Sociales",
            "prefix" => "demo",
        ]);
        Subject::create([
            "idsubject" => 8,
            "idarea" => 5,
            "name" => "Ciencias Económicas",
            "shortname" => "Ciencias Económicas",
            "prefix" => "ciec",
        ]);
        Subject::create([
            "idsubject" => 9,
            "idarea" => 5,
            "name" => "Ciencias Políticas",
            "shortname" => "Ciencias Políticas",
            "prefix" => "cipo",
        ]);
        Subject::create([
            "idsubject" => 10,
            "idarea" => 5,
            "name" => "Ciencias Políticas y  Económicas",
            "shortname" => "Ciencias Económicas",
            "prefix" => "cpce",
        ]);
        Subject::create([
            "idsubject" => 11,
            "idarea" => 6,
            "name" => "Filosofía",
            "shortname" => "Filosofía",
            "prefix" => "filo",
        ]);
        Subject::create([
            "idsubject" => 12,
            "idarea" => 7,
            "name" => "Educación Artística",
            "shortname" => "Educación Artística",
            "prefix" => "arte",
        ]);
        Subject::create([
            "idsubject" => 13,
            "idarea" => 7,
            "name" => "Educación Artística: Dibujo Publicitario",
            "shortname" => "Dibujo Publicitario",
            "prefix" => "publ",
        ]);
        Subject::create([
            "idsubject" => 14,
            "idarea" => 7,
            "name" => "Educación Artística: Dibujo Técnico",
            "shortname" => "Dibujo Técnico",
            "prefix" => "dibu",
        ]);
        Subject::create([
            "idsubject" => 15,
            "idarea" => 7,
            "name" => "Educación Artística: Artes Plásticas",
            "shortname" => "Artes Plásticas",
            "prefix" => "expa",
        ]);
        Subject::create([
            "idsubject" => 16,
            "idarea" => 7,
            "name" => "Educación Artística: Expresión Corporal",
            "shortname" => "Expresión Corporal",
            "prefix" => "exps",
        ]);
        Subject::create([
            "idsubject" => 17,
            "idarea" => 7,
            "name" => "Educación Artística: Música",
            "shortname" => "Música",
            "prefix" => "musi",
        ]);
        Subject::create([
            "idsubject" => 18,
            "idarea" => 7,
            "name" => "Educación Artística: Talla en Madera",
            "shortname" => "Talla en Madera",
            "prefix" => "made",
        ]);
        Subject::create([
            "idsubject" => 19,
            "idarea" => 8,
            "name" => "Ciencias Naturales",
            "shortname" => "Ciencias Naturales",
            "prefix" => "cnea",
        ]);
        Subject::create([
            "idsubject" => 20,
            "idarea" => 8,
            "name" => "Física",
            "shortname" => "Física",
            "prefix" => "fisi",
        ]);
        Subject::create([
            "idsubject" => 21,
            "idarea" => 8,
            "name" => "Química",
            "shortname" => "Química",
            "prefix" => "quim",
        ]);
        Subject::create([
            "idsubject" => 22,
            "idarea" => 9,
            "name" => "Emprendimiento y Empresarismo",
            "shortname" => "Emprendimiento",
            "prefix" => "empr",
        ]);
        Subject::create([
            "idsubject" => 23,
            "idarea" => 10,
            "name" => "Educación Física, Recreación y Deportes",
            "shortname" => "Educación Física",
            "prefix" => "efrd",
        ]);
        Subject::create([
            "idsubject" => 24,
            "idarea" => 11,
            "name" => "Educación Religiosa",
            "shortname" => "Educación Religiosa",
            "prefix" => "edre",
        ]);
        Subject::create([
            "idsubject" => 25,
            "idarea" => 12,
            "name" => "Educación Ética y en Valores Humanos",
            "shortname" => "Educación Ética",
            "prefix" => "eevh",
        ]);
        Subject::create([
            "idsubject" => 26,
            "idarea" => 13,
            "name" => "Dimensión Cognitiva: Ciencias",
            "shortname" => "Dimensión Cognitiva",
            "prefix" => "cogncnea",
        ]);
        Subject::create([
            "idsubject" => 27,
            "idarea" => 13,
            "name" => "Dimensión Cognitiva: Matemáticas",
            "shortname" => "Dimensión Cognitiva",
            "prefix" => "cognmath",
        ]);
        Subject::create([
            "idsubject" => 28,
            "idarea" => 13,
            "name" => "Dimensión Cognitiva",
            "shortname" => "Dimensión Cognitiva",
            "prefix" => "cogn",
        ]);
        Subject::create([
            "idsubject" => 29,
            "idarea" => 14,
            "name" => "Dimensión Comunicativa",
            "shortname" => "Dimensión Comunicativa",
            "prefix" => "comu",
        ]);
        Subject::create([
            "idsubject" => 30,
            "idarea" => 14,
            "name" => "Dimensión Comunicativa: Idioma Extranjero",
            "shortname" => "Dimensión Comunicativa",
            "prefix" => "comuingl",
        ]);
        Subject::create([
            "idsubject" => 31,
            "idarea" => 14,
            "name" => "Dimensión Comunicativa: Lengua Castellana",
            "shortname" => "Dimensión Comunicativa",
            "prefix" => "comuespa",
        ]);
        Subject::create([
            "idsubject" => 32,
            "idarea" => 15,
            "name" => "Dimensión Corporal",
            "shortname" => "Dimensión Corporal",
            "prefix" => "corp",
        ]);
        Subject::create([
            "idsubject" => 33,
            "idarea" => 15,
            "name" => "Dimensión Corporal: Motricidad Fina",
            "shortname" => "Motricidad Fina",
            "prefix" => "corpfina",
        ]);
        Subject::create([
            "idsubject" => 34,
            "idarea" => 15,
            "name" => "Dimensión Corporal: Motricidad Gruesa",
            "shortname" => "Motricidad Gruesa",
            "prefix" => "corpgrue",
        ]);
        Subject::create([
            "idsubject" => 35,
            "idarea" => 16,
            "name" => "Dimensión Estética",
            "shortname" => "Dimensión Estética",
            "prefix" => "este",
        ]);
        Subject::create([
            "idsubject" => 36,
            "idarea" => 16,
            "name" => "Dimensión Estética: Aprestamiento Artístico",
            "shortname" => "Aprestamiento Artístico",
            "prefix" => "estearte",
        ]);
        Subject::create([
            "idsubject" => 37,
            "idarea" => 16,
            "name" => "Dimensión Estética: Aprestamiento Musical",
            "shortname" => "Aprestamiento Musical",
            "prefix" => "estemusi",
        ]);
        Subject::create([
            "idsubject" => 38,
            "idarea" => 17,
            "name" => "Dimensión Socio-Afectiva",
            "shortname" => "Dimensión Socio-Afectiva",
            "prefix" => "soaf",
        ]);
        Subject::create([
            "idsubject" => 39,
            "idarea" => 18,
            "name" => "Tecnología e Informática",
            "shortname" => "Tecnología e Informática",
            "prefix" => "tecn",
        ]);
        Subject::create([
            "idsubject" => 40,
            "idarea" => 19,
            "name" => "Convivencia",
            "shortname" => "Convivencia",
            "prefix" => "conv",
        ]);
        Subject::create([
            "idsubject" => 41,
            "idarea" => 21,
            "name" => "Electiva",
            "shortname" => "Electiva",
            "prefix" => "elec",
        ]);
        Subject::create([
            "idsubject" => 42,
            "idarea" => 22,
            "name" => "Cívica y Urbanidad",
            "shortname" => "Cívica y Urbanidad",
            "prefix" => "civi",
        ]);
        Subject::create([
            "idsubject" => 43,
            "idarea" => 23,
            "name" => "Proyecto de Vida",
            "shortname" => "Proyecto de Vida",
            "prefix" => "life",
        ]);
        Subject::create([
            "idsubject" => 44,
            "idarea" => 1,
            "name" => "Francés",
            "shortname" => "Francés",
            "prefix" => "fran",
        ]);
        Subject::create([
            "idsubject" => 45,
            "idarea" => 24,
            "name" => "Dimensión Afectiva",
            "shortname" => "Dimensión Afectiva",
            "prefix" => "afec",
        ]);
        Subject::create([
            "idsubject" => 46,
            "idarea" => 25,
            "name" => "Dimensión Ética",
            "shortname" => "Dimensión Ética",
            "prefix" => "etic",
        ]);
        Subject::create([
            "idsubject" => 47,
            "idarea" => 26,
            "name" => "Dimensión Actitudinal y Valorativa",
            "shortname" => "Dimensión Actitudinal",
            "prefix" => "act",
        ]);
        Subject::create([
            "idsubject" => 48,
            "idarea" => 1,
            "name" => "Profundización : Francés",
            "shortname" => "Profundización : Francés",
            "prefix" => "proffran",
        ]);
        Subject::create([
            "idsubject" => 49,
            "idarea" => 2,
            "name" => "Profundización : Matemáticas",
            "shortname" => "Profundización : Matemáticas",
            "prefix" => "profmath",
        ]);
        Subject::create([
            "idsubject" => 50,
            "idarea" => 8,
            "name" => "Profundización : Química",
            "shortname" => "Profundización : Química",
            "prefix" => "profquim",
        ]);
        Subject::create([
            "idsubject" => 51,
            "idarea" => 8,
            "name" => "Profundización : Física",
            "shortname" => "Profundización : Física",
            "prefix" => "proffisi",
        ]);
        Subject::create([
            "idsubject" => 52,
            "idarea" => 7,
            "name" => "Educación Artística: Teatro",
            "shortname" => "Educación Artística: Teatro",
            "prefix" => "teatro",
        ]);
        Subject::create([
            "idsubject" => 53,
            "idarea" => 27,
            "name" => "Profundización",
            "shortname" => "Profundización",
            "prefix" => "profu",
        ]);
        Subject::create([
            "idsubject" => 54,
            "idarea" => 28,
            "name" => "Acompañamiento de la Familia",
            "shortname" => "Acompañamiento de la Familia",
            "prefix" => "family",
        ]);

    }

}