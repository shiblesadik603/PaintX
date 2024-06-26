<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Shible Sadik',
                'username' => 'shible',
                'email' => 'shible@email.com',
                'password' => bcrypt('1234'),
                'phone' => '01762002498',
                'address' => 'Kuet',
                'photo' => 'shible.jpg',
                'role' => 'admin',
            ]
        ];
        DB::table('users')->insert($users);
    }
}
