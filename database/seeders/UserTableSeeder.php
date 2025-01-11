<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'churchadmin@gmail.com',
            'password' => Hash::make('superadmin***'),
            'email_verified_at' => Carbon::now(),
        ]);


        // Create a normal user
        $normalUser1 = User::create([
            'name' => 'Test User 1',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now(),
        ]);

        $normalUser2 = User::create([
            'name' => 'Test User 2',
            'email' => 'user2@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now(),
        ]);

        // Attach roles to users
        $adminRole = Role::where('role', 'admin')->first();
        $userRole = Role::where('role', 'user')->first();

        $adminUser->roles()->attach($adminRole);
        $normalUser1->roles()->attach($userRole);
        $normalUser2->roles()->attach($userRole);


    }
}
