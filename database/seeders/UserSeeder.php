<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; //Panggil model user

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //masukan data user admin ke database
        // User::create([
        //     'name' => 'Administrator',
        //     'email' => 'Aldimas.admin@admin.com',
        //     'password' => 'admin',
        //     'status' => 'active',
        //     'role' => 'admin',
        // ]);

        User::factory()->count(10)->create();
    }
}
