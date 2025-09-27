<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Hüseyin Emeci',
            'email' => 'yonetici@huseyinemeci.com',
            'password' => bcrypt('password'),
        ]);

        $admin->assignRole('admin');
    }
}
