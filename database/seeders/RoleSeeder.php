<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'id' => Uuid::uuid4()->toString(),
                'role_name' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'role_name' => 'User',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan peran lainnya di sini sesuai kebutuhan
        ];

        // Masukkan data ke dalam tabel roles
        DB::table('roles')->insert($roles);
    }
}
