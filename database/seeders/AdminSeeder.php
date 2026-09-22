<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->firstOrFail();

        User::updateOrCreate(
            [
                'email' => 'admin@example.com',
            ],
            [
                'name' => 'Admin',
                'password' => Hash::make('Admin@12345'),
                'role_id' => $adminRole->id,
            ]
        );
    }
}