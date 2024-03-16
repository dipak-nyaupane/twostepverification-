<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\backend\Genders;

class GendersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
            [
                'name' => 'Male',

            ],

            [
                'name' => 'Female',

            ],

            [
                'name' => 'Others',

            ],
            // Add more records as needed
        ];

        foreach ($users as $userData) {
            Genders::create($userData);
        }
    }
}
