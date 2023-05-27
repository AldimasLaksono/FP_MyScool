<?php

namespace Database\Seeders;

use App\Models\Userteacher;
use App\Models\Userstudent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //masukan data user admin ke database
        // Userteacher::create([
        //     'id_mja'=>'1',
        //     'nip'=>'0001',
        //     'name_mut' => 'Administrator',
        //     'ttl_mut'=>'Semarang,05/10/2000',
        //     'gender_mut'=>'L',
        //     'alamat_mut'=>'Jl.Ketileng indah blok H no.114 Semarang, Jawa Tengah, Indonesia',
        //     'notelp_mut'=>'085559579359',
        //     'email_mut' => 'Aldimas.admin@admin.com',
        //     'status_mut'=>'tetap',
        //     'role_mut'=>'admin',
        //     'password' => 'admin',
        //     'status' => 'active',
        // ]);

        //masukan data user student ke database
        Userstudent::create([
            'nis'=>'0001',
            'name_mus' => 'Aldimas laksono',
            'ttl_mus'=>'Semarang,05/10/2000',
            'gender_mus'=>'L',
            'alamat_mus'=>'Jl.Ketileng indah blok H no.114 Semarang, Jawa Tengah, Indonesia',
            'notelp_mus'=>'085559579359',
            'email_mus' => 'Aldimas.admin@admin.com',
            'password' => 'aldimas',
            'status_mus' => 'active',
        ]);

        //Userteacher::factory()->count(10)->create();
    }
}
