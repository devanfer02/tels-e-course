<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminId = Uuid::uuid7();

        Role::insert([
            [
                'id' => Uuid::uuid7(),
                'role_name' => 'User'
            ],
            [
                'id' => $adminId,
                'role_name' => 'Admin'
            ]
        ]);

        User::insert(
            [
                [
                    'id' => Uuid::uuid7(),
                    'fullname' => 'Admin 1',
                    'email' => 'adminmpsb1@gmail.com',
                    'password' => Hash::make('kitalopburetno120224'),
                    'role_id' => $adminId
                ],

                // KELAS B
                [
                    'id' => Uuid::uuid7(),
                    'fullname' => 'Admin Kelompok 2B',
                    'email' => 'kelompok2B@gmail.com',
                    'password' => Hash::make('klp2bbk'),
                    'role_id' => $adminId
                ],
                [
                    'id' => Uuid::uuid7(),
                    'fullname' => 'Admin Kelompok 3B',
                    'email' => 'kelompok3B@gmail.com',
                    'password' => Hash::make('klp3bk3lh'),
                    'role_id' => $adminId
                ],
                [
                    'id' => Uuid::uuid7(),
                    'fullname' => 'Admin Kelompok 4B',
                    'email' => 'kelompok4B@gmail.com',
                    'password' => Hash::make('klp4bif'),
                    'role_id' => $adminId
                ],
                [
                    'id' => Uuid::uuid7(),
                    'fullname' => 'Admin Kelompok 5B',
                    'email' => 'kelompok5B@gmail.com',
                    'password' => Hash::make('klp5bmjt'),
                    'role_id' => $adminId
                ],

                // KELAS A
                [
                    'id' => Uuid::uuid7(),
                    'fullname' => 'Admin Kelompok 1A',
                    'email' => 'kelompok1A@gmail.com',
                    'password' => Hash::make('klp1abk'),
                    'role_id' => $adminId
                ],
                [
                    'id' => Uuid::uuid7(),
                    'fullname' => 'Admin Kelompok 3A',
                    'email' => 'kelompok3A@gmail.com',
                    'password' => Hash::make('klp3ask'),
                    'role_id' => $adminId
                ],
                [
                    'id' => Uuid::uuid7(),
                    'fullname' => 'Admin Kelompok 4A',
                    'email' => 'kelompok4A@gmail.com',
                    'password' => Hash::make('klp4asa'),
                    'role_id' => $adminId
                ],
                [
                    'id' => Uuid::uuid7(),
                    'fullname' => 'Admin Kelompok 5A',
                    'email' => 'kelompok5A@gmail.com',
                    'password' => Hash::make('klp5atik'),
                    'role_id' => $adminId
                ],
                [
                    'id' => Uuid::uuid7(),
                    'fullname' => 'Admin Kelompok 6A',
                    'email' => 'kelompok6A@gmail.com',
                    'password' => Hash::make('klp6ajki'),
                    'role_id' => $adminId
                ],
                [
                    'id' => Uuid::uuid7(),
                    'fullname' => 'Admin Kelompok 7A',
                    'email' => 'kelompok7A@gmail.com',
                    'password' => Hash::make('klp7abk'),
                    'role_id' => $adminId
                ],
                [
                    'id' => Uuid::uuid7(),
                    'fullname' => 'Admin Kelompok 8A',
                    'email' => 'kelompok8A@gmail.com',
                    'password' => Hash::make('klp8ask'),
                    'role_id' => $adminId
                ],

                // Kelas C
                [
                    'id' => Uuid::uuid7(),
                    'fullname' => 'Admin Kelompok 1C',
                    'email' => 'kelompok1C@gmail.com',
                    'password' => Hash::make('klp1cpam'),
                    'role_id' => $adminId
                ],
                [
                    'id' => Uuid::uuid7(),
                    'fullname' => 'Admin Kelompok 2C',
                    'email' => 'kelompok2C@gmail.com',
                    'password' => Hash::make('klp2caok'),
                    'role_id' => $adminId
                ],
                [
                    'id' => Uuid::uuid7(),
                    'fullname' => 'Admin Kelompok 3C',
                    'email' => 'kelompok3C@gmail.com',
                    'password' => Hash::make('klp3sfuk'),
                    'role_id' => $adminId
                ],
                [
                    'id' => Uuid::uuid7(),
                    'fullname' => 'Admin Kelompok 4C',
                    'email' => 'kelompok4C@gmail.com',
                    'password' => Hash::make('klp4ckdok'),
                    'role_id' => $adminId
                ],
                [
                    'id' => Uuid::uuid7(),
                    'fullname' => 'Admin Kelompok 5C',
                    'email' => 'kelompok5C@gmail.com',
                    'password' => Hash::make('klp5cika'),
                    'role_id' => $adminId
                ],
                [
                    'id' => Uuid::uuid7(),
                    'fullname' => 'Admin Kelompok 6C',
                    'email' => 'kelompok6C@gmail.com',
                    'password' => Hash::make('klp6cpka'),
                    'role_id' => $adminId
                ],
                [
                    'id' => Uuid::uuid7(),
                    'fullname' => 'Admin Kelompok 7C',
                    'email' => 'kelompok7C@gmail.com',
                    'password' => Hash::make('klp7clka'),
                    'role_id' => $adminId
                ],

                // OTHERS
                [
                    'id' => Uuid::uuid7(),
                    'fullname' => 'Bos Besar',
                    'email' => 'pmkelasa@gmail.com',
                    'password' => Hash::make('iniakunbosbesarpma'),
                    'role_id' => $adminId
                ],
                [
                    'id' => Uuid::uuid7(),
                    'fullname' => 'Bos Kecil 2',
                    'email' => 'pmkelasc@gmail.com',
                    'password' => Hash::make('kelasgwssmgtpmc'),
                    'role_id' => $adminId
                ],
                [
                    'id' => Uuid::uuid7(),
                    'fullname' => 'Tim FE',
                    'email' => 'mpsbfeteam@gmail.com',
                    'password' => Hash::make('timfevercelapp'),
                    'role_id' => $adminId
                ],
            ]
        );
    }
}
