<?php

use Illuminate\Database\Seeder;
use SigeTurbo\Accounttype;

class AccounttypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounttypes')->delete();
        Accounttype::create(array('name' => 'CAJA GENERAL', 'code' => '110505', 'order' => 1));
        Accounttype::create(array('name' => 'BCO BBVA CTE', 'code' => '11100505', 'order' => 3));
        Accounttype::create(array('name' => 'BCO AV VILLAS', 'code' => '11100510', 'order' => 4));
        Accounttype::create(array('name' => 'BCO BBVA AHORR', 'code' => '11200505', 'order' => 2));
        Accounttype::create(array('name' => 'PENSIONES', 'code' => '13050510', 'order' => 7));
        Accounttype::create(array('name' => 'ING. PENSIÓN', 'code' => '41600510', 'order' => 8));
        Accounttype::create(array('name' => 'MATRÍCULA', 'code' => '13050505', 'order' => 5));
        Accounttype::create(array('name' => 'ING. MATRÍCULA', 'code' => '41600505', 'order' => 6));
        Accounttype::create(array('name' => 'DCTOS', 'code' => '417510', 'order' => 9));
        Accounttype::create(array('name' => 'INTERESES', 'code' => '421005', 'order' => 10));
        Accounttype::create(array('name' => 'GUÍAS', 'code' => '41609505', 'order' => 11));
        Accounttype::create(array('name' => 'SALIDAS PEDAGÓGICAS', 'code' => '41609510', 'order' => 12));
        Accounttype::create(array('name' => 'LUDOTECA', 'code' => '41609515', 'order' => 13));
        Accounttype::create(array('name' => 'DERECHOS DE GRADO', 'code' => '41609520', 'order' => 14));
        Accounttype::create(array('name' => 'CARNÉ, AGENGAS', 'code' => '41609595', 'order' => 15));
        Accounttype::create(array('name' => 'OTROS COSTOS', 'code' => '13050520', 'order' => 16));
        Accounttype::create(array('name' => 'EXTRACURRICULARES', 'code' => '41609525', 'order' => 17));
        Accounttype::create(array('name' => 'APROVECHAMIENTO', 'code' => '429505', 'order' => 18));
        Accounttype::create(array('name' => 'ANTICIPOS', 'code' => '270545', 'order' => 19));
        Accounttype::create(array('name' => 'VALIDACIONES', 'code' => '41609530', 'order' => 20));
        Accounttype::create(array('name' => 'CLIENTES AÑOS ANTERIORES', 'code' => '13050515', 'order' => 21));
    }
}
