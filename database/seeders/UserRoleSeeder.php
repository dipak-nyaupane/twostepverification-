<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\backend\UserRole;
class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  // UserTableSeeder.php
public function run()
{
    $users = [
        [
            'name' => 'admin',
            'description' => 'admin has all access',
        ],

        [
            'name' => 'manager',
            'description' => 'manager role',
        ],
        // Add more records as needed
    ];

    foreach ($users as $userData) {
        UserRole::create($userData);
    }
}

}
