<?php


use Illuminate\Database\Seeder;
use SigeTurbo\Statuspurchase;

class StatuspurchasesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('statuspurchases')->delete();
        Statuspurchase::create([
            'name' => 'Draft',
        ]);
        Statuspurchase::create([
            'name' => 'Accepted',
        ]);
        Statuspurchase::create([
            'name' => 'In Evaluation',
        ]);
        Statuspurchase::create([
            'name' => 'Evaluated',
        ]);
        Statuspurchase::create([
            'name' => 'Rejected',
        ]);
    }

}