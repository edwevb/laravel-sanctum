<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Admin Edward',
                'email' => 'admin@email.com',
                'username' => 'admin',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'User John',
                'email' => 'john@email.com',
                'username' => 'john',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'User Cleo',
                'email' => 'cleo@email.com',
                'username' => 'cleo',
                'password' => Hash::make('password'),
            ],
        ];

        User::insert($data);
    }
}
