<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use SigeTurbo\User;

class UsersTableSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'iduser' => 99999996,
            'idcategory' => 13,
            'idstatus' => 1,
            'idmaritalstatus' => 3,
            'idreligion' => 1,
            'idethnicgroup' => 1,
            'idgender' => 1,
            'idtown' => 5001,
            'idstratus' => 1,
            'username' => 'foobar',
            'email' => 'foobar@bar.com',
            'password' => Hash::make('*abc123*'),
            'firstname' => 'FooBar',
            'lastname' => 'Bar',
            'photo' => 'sigeturbo.jpg',
            'role' => 'Teacher',
            'role_selected' => 'Teacher',
            'api_token' => str_random(60),
            'points' => '100',
        ]);

        User::create([
            'iduser' => 99999997,
            'idcategory' => 27,
            'idstatus' => 1,
            'idmaritalstatus' => 3,
            'idreligion' => 1,
            'idethnicgroup' => 1,
            'idgender' => 1,
            'idtown' => 5001,
            'idstratus' => 1,
            'username' => 'foo',
            'email' => 'foo@bar.com',
            'password' => Hash::make('*abc123*'),
            'firstname' => 'Foo',
            'lastname' => 'Bar',
            'photo' => 'sigeturbo.jpg',
            'role' => 'Admin,Teacher',
            'role_selected' => 'Admin',
            'api_token' => str_random(60),
            'points' => '100',
        ]);

        User::create([
            'iduser' => 2017001,
            'idcategory' => 13,
            'idstatus' => 1,
            'idmaritalstatus' => 3,
            'idreligion' => 1,
            'idethnicgroup' => 1,
            'idgender' => 1,
            'idtown' => 5001,
            'idstratus' => 1,
            'username' => 'bar',
            'email' => 'bar@foo.com',
            'password' => Hash::make('*abc123*'),
            'firstname' => 'Bar',
            'lastname' => 'Foo',
            'photo' => 'sigeturbo.jpg',
            'role' => 'Student',
            'role_selected' => 'Student',
            'api_token' => str_random(60),
            'points' => '100',
        ]);

        User::create([
            'iduser' => 2017002,
            'idcategory' => 13,
            'idstatus' => 1,
            'idmaritalstatus' => 3,
            'idreligion' => 1,
            'idethnicgroup' => 1,
            'idgender' => 1,
            'idtown' => 5001,
            'idstratus' => 1,
            'username' => 'foofoo',
            'email' => 'foofoo@bar.com',
            'password' => Hash::make('*abc123*'),
            'firstname' => 'FooFoo',
            'lastname' => 'Bar',
            'photo' => 'sigeturbo.jpg',
            'role' => 'Student',
            'role_selected' => 'Students',
            'api_token' => str_random(60),
            'points' => '100',
        ]);

    }

}
