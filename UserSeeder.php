<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    
        User::create([
            'name'     => 'Sarah Mitchell',
            'email'    => 'sarah@example.com',
            'password' => bcrypt('password123'),
        ]);

        User::create([
            'name'     => 'Maya Johnson',
            'email'    => 'maya@example.com',
            'password' => bcrypt('password123'),
        ]);

        User::create([
            'name'     => 'Priya Patel',
            'email'    => 'priya@example.com',
            'password' => bcrypt('password123'),
        ]);

        User::create([
            'name'     => 'Emma Clarke',
            'email'    => 'emma@example.com',
            'password' => bcrypt('password123'),
        ]);

        User::create([
            'name'     => 'Anonymous User',
            'email'    => 'anon@example.com',
            'password' => bcrypt('password123'),
        ]);
    }
}
