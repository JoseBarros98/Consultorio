<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Services\UserGeneratorService;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $ci = '12345678';
        
        $admin = User::firstOrCreate(
            ['email' => 'admin@consultorio.com'],
            [
                'first_name' => 'Admin',
                'last_name_father' => 'User',
                'ci' => $ci,
                'ci_extension' => 'TJ',
                'birth_date' => '1998-05-02',
                'phone' => '123456789',
                'username' => UserGeneratorService::generateUsername('Admin', 'User'),
                'password' => bcrypt(UserGeneratorService::generatePassword($ci)),
                'active' => true,
            ]
        );

        $admin -> assignRole('admin');
    }
}
