<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersData = [
            [
                'name' => 'NXTYOU',
                'email' => 'accounts@nxtyou.de',
                'password' => 'gVRDLfcOLzsHhsB',
                'role' => 'Super Admin',
            ],
            [
                'name' => 'NXTYOU 2',
                'email' => 'accounts.2@nxtyou.de',
                'password' => '63R46ovCj30W',
                'role' => 'Admin',
            ],
        ];

        foreach ($usersData as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
            ]);
            $user->assignRole($userData['role']);
        }
    }
}
