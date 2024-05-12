<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id'=> 1,
                'name'=> 'Erick',
                'email'=> 'erick@myjobs.com',
                'password'=> bcrypt('erick123'),
            ],
            [
                'id'=> 2,
                'name'=> 'Eduardo',
                'email'=> 'eduardo@myjobs.com',
                'password'=> bcrypt('eduardo123'),
            ],
            [
                'id'=> 3,
                'name'=> 'Giovana',
                'email'=> 'giovana@myjobs.com',
                'password'=> bcrypt('giovana123'),
            ],
        ]);

    }
}