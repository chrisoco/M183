<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DefaultAccSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'     => 'admin',
                'email'    => 'admin@appli.ch',
                'password' => Hash::make('123'),
                'role_id'  => 2,
            ],[
                'name'     => 'user',
                'email'    => 'user@appli.ch',
                'password' => Hash::make('123'),
                'role_id'  => 1,
            ]
        ];

        DB::table('users')->insert($users);
    }
}
