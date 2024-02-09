<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        App\User::create([
            'name' => 'Allen',
            'email' => 'allen@gmail.com',
            'phone' => '971456788909',
            'role' => 'customer',
            'address' => 'dubai',
            'expertise' => '',
            'password' => '123456'
        ]);

        App\User::create([
            'name' => 'Sam',
            'email' => 'sam@gmail.com',
            'phone' => '971456700909',
            'role' => 'staff',
            'address' => 'dubai',
            'expertise' => 'cleaning',
            'password' => '123456'
        ]);

        App\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '971456700009',
            'role' => 'admin',
            'address' => 'dubai',
            'expertise' => 'all',
            'password' => '123456'
        ]);
    }
}
