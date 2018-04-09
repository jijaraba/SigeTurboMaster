<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Nivel;

class NivelsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('nivels')->delete();
        Nivel::create([
            'idnivel' => 1,
            'idsubject' => 1,
            'name' => 'Grupo Entero'
        ]);
        Nivel::create([
            'idnivel' => 2,
            "idsubject" => 2,
            "name" => "Básico",
        ]);
        Nivel::create([
            'idnivel' => 3,
            "idsubject" => 2,
            "name" => "Intermedio",
        ]);
        Nivel::create([
            'idnivel' => 4,
            "idsubject" => 2,
            "name" => "Avanzado",
        ]);
        Nivel::create([
            'idnivel' => 5,
            "idsubject" => 12,
            "name" => "Arte",
        ]);
        Nivel::create([
            'idnivel' => 6,
            "idsubject" => 12,
            "name" => "Música",
        ]);
        Nivel::create([
            'idnivel' => 7,
            "idsubject" => 12,
            "name" => "Dibujo",
        ]);
        Nivel::create([
            'idnivel' => 8,
            "idsubject" => 2,
            "name" => "A1.0",
        ]);
        Nivel::create([
            'idnivel' => 9,
            "idsubject" => 2,
            "name" => "A1.1",
        ]);
        Nivel::create([
            'idnivel' => 10,
            "idsubject" => 2,
            "name" => "A1.2",
        ]);
        Nivel::create([
            'idnivel' => 11,
            "idsubject" => 2,
            "name" => "A1.3",
        ]);
        Nivel::create([
            'idnivel' => 12,
            "idsubject" => 2,
            "name" => "A2.0",
        ]);
        Nivel::create([
            'idnivel' => 13,
            "idsubject" => 2,
            "name" => "B1.0",
        ]);
        Nivel::create([
            'idnivel' => 14,
            "idsubject" => 2,
            "name" => "B2.0",
        ]);
        Nivel::create([
            'idnivel' => 15,
            "idsubject" => 2,
            "name" => "B2.1",
        ]);
        Nivel::create([
            'idnivel' => 16,
            "idsubject" => 2,
            "name" => "B2.2",
        ]);
        Nivel::create([
            'idnivel' => 17,
            "idsubject" => 2,
            "name" => "C1.0",
        ]);
        Nivel::create([
            'idnivel' => 18,
            "idsubject" => 41,
            "name" => "Cocina",
        ]);
        Nivel::create([
            'idnivel' => 19,
            "idsubject" => 41,
            "name" => "Math Challenges",
        ]);
        Nivel::create([
            'idnivel' => 20,
            "idsubject" => 41,
            "name" => "Átomos Kids",
        ]);
        Nivel::create([
            'idnivel' => 21,
            "idsubject" => 41,
            "name" => "Átomos Espaciales",
        ]);
        Nivel::create([
            'idnivel' => 22,
            "idsubject" => 41,
            "name" => "Cooking",
        ]);
        Nivel::create([
            'idnivel' => 23,
            "idsubject" => 41,
            "name" => "Talla en Madera",
        ]);
        Nivel::create([
            'idnivel' => 24,
            "idsubject" => 41,
            "name" => "Origami in English",
        ]);
        Nivel::create([
            'idnivel' => 25,
            "idsubject" => 41,
            "name" => "Manualidades",
        ]);
        Nivel::create([
            'idnivel' => 26,
            "idsubject" => 41,
            "name" => "Francés",
        ]);
        Nivel::create([
            'idnivel' => 27,
            "idsubject" => 41,
            "name" => "Metamorfosis",
        ]);
        Nivel::create([
            'idnivel' => 28,
            "idsubject" => 41,
            "name" => "The Net",
        ]);
        Nivel::create([
            'idnivel' => 29,
            "idsubject" => 41,
            "name" => "Actividad Deportiva",
        ]);
        Nivel::create([
            'idnivel' => 30,
            "idsubject" => 41,
            "name" => "Producción Musical",
        ]);
        Nivel::create([
            'idnivel' => 31,
            "idsubject" => 41,
            "name" => "Teatro",
        ]);
        Nivel::create([
            'idnivel' => 32,
            "idsubject" => 41,
            "name" => "Argonautas",
        ]);
        Nivel::create([
            'idnivel' => 33,
            "idsubject" => 41,
            "name" => "Comprensión Lectura-Lenguaje",
        ]);
        Nivel::create([
            'idnivel' => 34,
            "idsubject" => 41,
            "name" => "Biología y Química",
        ]);
        Nivel::create([
            'idnivel' => 35,
            "idsubject" => 41,
            "name" => "Física y Matemáticas",
        ]);
        Nivel::create([
            'idnivel' => 36,
            "idsubject" => 41,
            "name" => "Pruebas de Orientación Vocacional",
        ]);
        Nivel::create([
            'idnivel' => 37,
            "idsubject" => 12,
            "name" => "Expresión Artística",
        ]);
        Nivel::create([
            'idnivel' => 38,
            "idsubject" => 41,
            "name" => "Edición Gráfica",
        ]);
        Nivel::create([
            'idnivel' => 39,
            "idsubject" => 41,
            "name" => "Improve you English!",
        ]);
        Nivel::create([
            'idnivel' => 40,
            "idsubject" => 41,
            "name" => "Decoración",
        ]);
        Nivel::create([
            'idnivel' => 41,
            "idsubject" => 41,
            "name" => "Danza Árabe",
        ]);
        Nivel::create([
            'idnivel' => 42,
            "idsubject" => 41,
            "name" => "Estudiantina",
        ]);
        Nivel::create([
            'idnivel' => 43,
            "idsubject" => 41,
            "name" => "Video Literatura",
        ]);
        Nivel::create([
            'idnivel' => 44,
            "idsubject" => 41,
            "name" => "Bioexplorers",
        ]);
        Nivel::create([
            'idnivel' => 45,
            "idsubject" => 41,
            "name" => "Vamos a Jugar",
        ]);
        Nivel::create([
            'idnivel' => 46,
            "idsubject" => 41,
            "name" => "Explorando Matemáticas",
        ]);
        Nivel::create([
            'idnivel' => 47,
            "idsubject" => 41,
            "name" => "Manualidades y Decoración",
        ]);
        Nivel::create([
            'idnivel' => 48,
            "idsubject" => 41,
            "name" => "Descubre tus Habilidades",
        ]);
        Nivel::create([
            'idnivel' => 49,
            "idsubject" => 41,
            "name" => "Explorer",
        ]);
        Nivel::create([
            'idnivel' => 50,
            "idsubject" => 41,
            "name" => "Primeros Auxilios",
        ]);
        Nivel::create([
            'idnivel' => 51,
            "idsubject" => 41,
            "name" => "Experiments",
        ]);
        Nivel::create([
            'idnivel' => 52,
            "idsubject" => 41,
            "name" => "Arts and Craft",
        ]);
        Nivel::create([
            'idnivel' => 53,
            "idsubject" => 41,
            "name" => "Arts and Craft",
        ]);
        Nivel::create([
            'idnivel' => 54,
            "idsubject" => 41,
            "name" => "Profundización en Lengua Castellana",
        ]);
        Nivel::create([
            'idnivel' => 55,
            "idsubject" => 41,
            "name" => "Bordado",
        ]);
        Nivel::create([
            'idnivel' => 56,
            "idsubject" => 41,
            "name" => "Capoeira",
        ]);
        Nivel::create([
            'idnivel' => 57,
            "idsubject" => 12,
            "name" => "Fotografía",
        ]);
        Nivel::create([
            'idnivel' => 58,
            "idsubject" => 41,
            "name" => "Let Go To The Movies",
        ]);
        Nivel::create([
            'idnivel' => 59,
            "idsubject" => 41,
            "name" => "Exploradores",
        ]);
        Nivel::create([
            'idnivel' => 60,
            "idsubject" => 41,
            "name" => "Escultura y Modelado",
        ]);
        Nivel::create([
            'idnivel' => 61,
            "idsubject" => 41,
            "name" => "Fotografía",
        ]);
        Nivel::create([
            'idnivel' => 62,
            "idsubject" => 41,
            "name" => "Medio Ambiente",
        ]);
        Nivel::create([
            'idnivel' => 63,
            "idsubject" => 41,
            "name" => "Inglés",
        ]);
        Nivel::create([
            'idnivel' => 64,
            "idsubject" => 41,
            "name" => "Into Music",
        ]);
        Nivel::create([
            'idnivel' => 65,
            "idsubject" => 41,
            "name" => "Reciclando Manualidades",
        ]);
        Nivel::create([
            'idnivel' => 66,
            "idsubject" => 41,
            "name" => "Arte Country",
        ]);
        Nivel::create([
            'idnivel' => 67,
            "idsubject" => 12,
            "name" => "Talla en Madera",
        ]);
        Nivel::create([
            'idnivel' => 68,
            "idsubject" => 1,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 69,
            "idsubject" => 4,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 70,
            "idsubject" => 5,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 71,
            "idsubject" => 6,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 72,
            "idsubject" => 7,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 73,
            "idsubject" => 8,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 74,
            "idsubject" => 9,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 75,
            "idsubject" => 10,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 76,
            "idsubject" => 11,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 77,
            "idsubject" => 13,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 78,
            "idsubject" => 14,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 79,
            "idsubject" => 15,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 80,
            "idsubject" => 16,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 81,
            "idsubject" => 17,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 82,
            "idsubject" => 18,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 83,
            "idsubject" => 19,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 84,
            "idsubject" => 20,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 85,
            "idsubject" => 21,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 86,
            "idsubject" => 22,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 87,
            "idsubject" => 23,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 88,
            "idsubject" => 24,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 89,
            "idsubject" => 25,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 90,
            "idsubject" => 26,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 91,
            "idsubject" => 27,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 92,
            "idsubject" => 28,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 93,
            "idsubject" => 29,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 94,
            "idsubject" => 30,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 95,
            "idsubject" => 31,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 96,
            "idsubject" => 32,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 97,
            "idsubject" => 33,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 98,
            "idsubject" => 34,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 99,
            "idsubject" => 35,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 100,
            "idsubject" => 36,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 101,
            "idsubject" => 37,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 102,
            "idsubject" => 38,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 103,
            "idsubject" => 39,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 104,
            "idsubject" => 40,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 105,
            "idsubject" => 42,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 106,
            "idsubject" => 43,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 107,
            "idsubject" => 12,
            "name" => "Escultura y Modelado",
        ]);
        Nivel::create([
            'idnivel' => 108,
            "idsubject" => 41,
            "name" => "Learning Office",
        ]);
        Nivel::create([
            'idnivel' => 109,
            "idsubject" => 41,
            "name" => "Diseño Desde Mi Mundo Interior",
        ]);
        Nivel::create([
            'idnivel' => 110,
            "idsubject" => 41,
            "name" => "Manga",
        ]);
        Nivel::create([
            'idnivel' => 111,
            "idsubject" => 41,
            "name" => "Banda",
        ]);
        Nivel::create([
            'idnivel' => 112,
            "idsubject" => 12,
            "name" => "Fotografía",
        ]);
        Nivel::create([
            'idnivel' => 113,
            "idsubject" => 41,
            "name" => "Completo",
        ]);
        Nivel::create([
            'idnivel' => 114,
            "idsubject" => 41,
            "name" => "Escucha IM Juicio",
        ]);
        Nivel::create([
            'idnivel' => 115,
            "idsubject" => 41,
            "name" => "Cine y Literatura",
        ]);
        Nivel::create([
            'idnivel' => 117,
            "idsubject" => 12,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 118,
            "idsubject" => 2,
            "name" => "A2.2",
        ]);
        Nivel::create([
            'idnivel' => 119,
            "idsubject" => 2,
            "name" => "B1.2",
        ]);
        Nivel::create([
            'idnivel' => 120,
            "idsubject" => 41,
            "name" => "Accesorios",
        ]);
        Nivel::create([
            'idnivel' => 121,
            "idsubject" => 41,
            "name" => "Juegos tradicionales",
        ]);
        Nivel::create([
            'idnivel' => 122,
            "idsubject" => 41,
            "name" => "Animation",
        ]);
        Nivel::create([
            'idnivel' => 123,
            "idsubject" => 41,
            "name" => "Elaboración de papel y cocina",
        ]);
        Nivel::create([
            'idnivel' => 124,
            "idsubject" => 41,
            "name" => "Trabajos en madera",
        ]);
        Nivel::create([
            'idnivel' => 125,
            "idsubject" => 41,
            "name" => "Costura",
        ]);
        Nivel::create([
            'idnivel' => 126,
            "idsubject" => 41,
            "name" => "Cine Alternativo",
        ]);
        Nivel::create([
            'idnivel' => 127,
            "idsubject" => 41,
            "name" => "Deportes",
        ]);
        Nivel::create([
            'idnivel' => 128,
            "idsubject" => 41,
            "name" => "Matemáticas",
        ]);
        Nivel::create([
            'idnivel' => 129,
            "idsubject" => 41,
            "name" => "Literatura",
        ]);
        Nivel::create([
            'idnivel' => 130,
            "idsubject" => 41,
            "name" => "Investigación",
        ]);
        Nivel::create([
            'idnivel' => 131,
            "idsubject" => 44,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 132,
            "idsubject" => 41,
            "name" => "Huerta",
        ]);
        Nivel::create([
            'idnivel' => 133,
            "idsubject" => 41,
            "name" => "Creando",
        ]);
        Nivel::create([
            'idnivel' => 134,
            "idsubject" => 41,
            "name" => "La escritura Personal: Carta",
        ]);
        Nivel::create([
            'idnivel' => 135,
            "idsubject" => 41,
            "name" => "Nivelación y refuerzo académico : Química",
        ]);
        Nivel::create([
            'idnivel' => 136,
            "idsubject" => 45,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 137,
            "idsubject" => 46,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 138,
            "idsubject" => 47,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 139,
            "idsubject" => 41,
            "name" => "Nivelación y refuerzo académico : Matemáticas",
        ]);
        Nivel::create([
            'idnivel' => 140,
            "idsubject" => 41,
            "name" => "Servicio Social",
        ]);
        Nivel::create([
            'idnivel' => 141,
            "idsubject" => 41,
            "name" => "Aprender a aprender",
        ]);
        Nivel::create([
            'idnivel' => 142,
            "idsubject" => 41,
            "name" => "Pintura",
        ]);
        Nivel::create([
            'idnivel' => 143,
            "idsubject" => 12,
            "name" => "Teatro",
        ]);
        Nivel::create([
            'idnivel' => 144,
            "idsubject" => 48,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 145,
            "idsubject" => 49,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 146,
            "idsubject" => 50,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 147,
            "idsubject" => 51,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 148,
            "idsubject" => 52,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 149,
            "idsubject" => 53,
            "name" => "Química",
        ]);
        Nivel::create([
            'idnivel' => 150,
            "idsubject" => 53,
            "name" => "Matemáticas",
        ]);
        Nivel::create([
            'idnivel' => 151,
            "idsubject" => 53,
            "name" => "Francés",
        ]);
        Nivel::create([
            'idnivel' => 152,
            "idsubject" => 53,
            "name" => "Física",
        ]);
        Nivel::create([
            'idnivel' => 153,
            "idsubject" => 1,
            "name" => "Básico",
        ]);
        Nivel::create([
            'idnivel' => 154,
            "idsubject" => 1,
            "name" => "Avanzado",
        ]);
        Nivel::create([
            'idnivel' => 155,
            "idsubject" => 54,
            "name" => "Grupo Entero",
        ]);
        Nivel::create([
            'idnivel' => 156,
            "idsubject" => 53,
            "name" => "Física teoría y practica",
        ]);
        Nivel::create([
            'idnivel' => 157,
            "idsubject" => 53,
            "name" => "Experimentación desde la física",
        ]);
        Nivel::create([
            'idnivel' => 158,
            "idsubject" => 53,
            "name" => "Bases Matemáticas de la Física",
        ]);
        Nivel::create([
            'idnivel' => 159,
            "idsubject" => 4,
            "name" => "Básico",
        ]);
        Nivel::create([
            'idnivel' => 160,
            "idsubject" => 4,
            "name" => "Avanzado",
        ]);
        Nivel::create([
            'idnivel' => 161,
            "idsubject" => 20,
            "name" => "Avanzado",
        ]);
        Nivel::create([
            'idnivel' => 162,
            "idsubject" => 20,
            "name" => "Básico",
        ]);
    }

}