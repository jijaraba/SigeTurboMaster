<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Subject;

class SubjectsTableSeeder extends Seeder {

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
			"prefix" => "spanish",
		]);
		Subject::create([
			"idsubject" => 2,
			"idarea" => 1,
			"name" => "Lengua Extranjera: Inglés L.A",
			"prefix" => "ingl",
		]);
		Subject::create([
			"idsubject" => 4,
			"idarea" => 2,
			"name" => "Matemáticas",
			"prefix" => "math",
		]);
		Subject::create([
			"idsubject" => 5,
			"idarea" => 3,
			"name" => "Ciencias Sociales en Lengua Castellana",
			"prefix" => "soco",
		]);
		Subject::create([
			"idsubject" => 6,
			"idarea" => 3,
			"name" => "Ciencias Sociales, Hist, Geog, Const Pol y Democracia.",
			"prefix" => "scst",
		]);
		Subject::create([
			"idsubject" => 7,
			"idarea" => 3,
			"name" => "Ciencias Sociales, Hist, Geog, Const Pol y Demo.",
			"prefix" => "demo",
		]);
		Subject::create([
			"idsubject" => 8,
			"idarea" => 5,
			"name" => "Ciencias Económicas",
			"prefix" => "ciec",
		]);
		Subject::create([
			"idsubject" => 9,
			"idarea" => 5,
			"name" => "Ciencias Políticas",
			"prefix" => "cipo",
		]);
		Subject::create([
			"idsubject" => 10,
			"idarea" => 5,
			"name" => "Ciencias Políticas y  Económicas",
			"prefix" => "cpce",
		]);
		Subject::create([
			"idsubject" => 11,
			"idarea" => 6,
			"name" => "Filosofía",
			"prefix" => "filo",
		]);
		Subject::create([
			"idsubject" => 12,
			"idarea" => 7,
			"name" => "Educación Artística",
			"prefix" => "arte",
		]);
		Subject::create([
			"idsubject" => 13,
			"idarea" => 7,
			"name" => "Educación Artística: Dibujo Publicitario",
			"prefix" => "publ",
		]);
		Subject::create([
			"idsubject" => 14,
			"idarea" => 7,
			"name" => "Educación Artística: Dibujo Técnico",
			"prefix" => "dibu",
		]);
		Subject::create([
			"idsubject" => 15,
			"idarea" => 7,
			"name" => "Educación Artística: Artes Plásticas",
			"prefix" => "expa",
		]);
		Subject::create([
			"idsubject" => 16,
			"idarea" => 7,
			"name" => "Educación Artística: Expresión Corporal",
			"prefix" => "exps",
		]);
		Subject::create([
			"idsubject" => 17,
			"idarea" => 7,
			"name" => "Educación Artística: Música",
			"prefix" => "musi",
		]);
		Subject::create([
			"idsubject" => 18,
			"idarea" => 7,
			"name" => "Educación Artística: Talla en Madera",
			"prefix" => "made",
		]);
		Subject::create([
			"idsubject" => 19,
			"idarea" => 8,
			"name" => "Ciencias Naturales",
			"prefix" => "cnea",
		]);
		Subject::create([
			"idsubject" => 20,
			"idarea" => 8,
			"name" => "Física",
			"prefix" => "fisi",
		]);
		Subject::create([
			"idsubject" => 21,
			"idarea" => 8,
			"name" => "Química",
			"prefix" => "quim",
		]);
		Subject::create([
			"idsubject" => 22,
			"idarea" => 9,
			"name" => "Emprendimiento y Empresarismo",
			"prefix" => "empr",
		]);
		Subject::create([
			"idsubject" => 23,
			"idarea" => 10,
			"name" => "Educación Física, Recreación y Deportes",
			"prefix" => "efrd",
		]);
		Subject::create([
			"idsubject" => 24,
			"idarea" => 11,
			"name" => "Educación Religiosa",
			"prefix" => "edre",
		]);
		Subject::create([
			"idsubject" => 25,
			"idarea" => 12,
			"name" => "Educación Ética y en Valores Humanos",
			"prefix" => "eevh",
		]);
		Subject::create([
			"idsubject" => 26,
			"idarea" => 13,
			"name" => "Dimensión Cognitiva: Ciencias",
			"prefix" => "cogncnea",
		]);
		Subject::create([
			"idsubject" => 27,
			"idarea" => 13,
			"name" => "Dimensión Cognitiva: Matemáticas",
			"prefix" => "cognmath",
		]);
		Subject::create([
			"idsubject" => 28,
			"idarea" => 13,
			"name" => "Dimensión Cognitiva ",
			"prefix" => "cogn",
		]);
		Subject::create([
			"idsubject" => 29,
			"idarea" => 14,
			"name" => "Dimensión Comunicativa",
			"prefix" => "comu",
		]);
		Subject::create([
			"idsubject" => 30,
			"idarea" => 14,
			"name" => "Dimensión Comunicativa: Idioma Extranjero",
			"prefix" => "comuingl",
		]);
		Subject::create([
			"idsubject" => 31,
			"idarea" => 14,
			"name" => "Dimensión Comunicativa: Lengua Castellana",
			"prefix" => "comuespa",
		]);
		Subject::create([
			"idsubject" => 32,
			"idarea" => 15,
			"name" => "Dimensión Corporal",
			"prefix" => "corp",
		]);
		Subject::create([
			"idsubject" => 33,
			"idarea" => 15,
			"name" => "Dimensión Corporal: Motricidad Fina",
			"prefix" => "corpfina",
		]);
		Subject::create([
			"idsubject" => 34,
			"idarea" => 15,
			"name" => "Dimensión Corporal: Motricidad Gruesa",
			"prefix" => "corpgrue",
		]);
		Subject::create([
			"idsubject" => 35,
			"idarea" => 16,
			"name" => "Dimensión Estética",
			"prefix" => "este",
		]);
		Subject::create([
			"idsubject" => 36,
			"idarea" => 16,
			"name" => "Dimensión Estética: Aprestamiento Artístico",
			"prefix" => "estearte",
		]);
		Subject::create([
			"idsubject" => 37,
			"idarea" => 16,
			"name" => "Dimensión Estética: Aprestamiento Musical",
			"prefix" => "estemusi",
		]);
		Subject::create([
			"idsubject" => 38,
			"idarea" => 17,
			"name" => "Dimensión Socio-Afectiva",
			"prefix" => "soaf",
		]);
		Subject::create([
			"idsubject" => 39,
			"idarea" => 18,
			"name" => "Tecnología e Informática",
			"prefix" => "tecn",
		]);
		Subject::create([
			"idsubject" => 40,
			"idarea" => 19,
			"name" => "Convivencia",
			"prefix" => "conv",
		]);
		Subject::create([
			"idsubject" => 41,
			"idarea" => 21,
			"name" => "Electiva",
			"prefix" => "elec",
		]);
		Subject::create([
			"idsubject" => 42,
			"idarea" => 22,
			"name" => "Cívica y Urbanidad",
			"prefix" => "civi",
		]);
		Subject::create([
			"idsubject" => 43,
			"idarea" => 23,
			"name" => "Proyecto de Vida",
			"prefix" => "life",
		]);
		Subject::create([
			"idsubject" => 44,
			"idarea" => 1,
			"name" => "Francés",
			"prefix" => "fran",
		]);
		Subject::create([
			"idsubject" => 45,
			"idarea" => 24,
			"name" => "Dimensión Afectiva",
			"prefix" => "afec",
		]);
		Subject::create([
			"idsubject" => 46,
			"idarea" => 25,
			"name" => "Dimensión Ética",
			"prefix" => "etic",
		]);
		Subject::create([
			"idsubject" => 47,
			"idarea" => 26,
			"name" => "Dimensión Actitudinal y Valorativa",
			"prefix" => "act",
		]);
		Subject::create([
			"idsubject" => 48,
			"idarea" => 1,
			"name" => "Profundización : Francés",
			"prefix" => "proffran",
		]);
		Subject::create([
			"idsubject" => 49,
			"idarea" => 2,
			"name" => "Profundización : Matemáticas",
			"prefix" => "profmath",
		]);
		Subject::create([
			"idsubject" => 50,
			"idarea" => 8,
			"name" => "Profundización : Química",
			"prefix" => "profquim",
		]);
		Subject::create([
			"idsubject" => 51,
			"idarea" => 8,
			"name" => "Profundización : Física",
			"prefix" => "proffisi",
		]);
		Subject::create([
			"idsubject" => 52,
			"idarea" => 7,
			"name" => "Educación Artística: Teatro",
			"prefix" => "teatro",
		]);
		Subject::create([
			"idsubject" => 53,
			"idarea" => 27,
			"name" => "Profundización",
			"prefix" => "profu",
		]);
		Subject::create([
			"idsubject" => 54,
			"idarea" => 28,
			"name" => "Acompañamiento de la Familia",
			"prefix" => "family",
		]);

	}

}