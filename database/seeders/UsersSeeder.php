<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Dipak Nyaupane',
            'email' => 'nyaupane04@gmail.com',
            'password' => Hash::make('password'),
            'username'=>'Dipak',
            'mobile_number'=>'9861939061',
            'gender'=>'1',
            'user_role'=>'1',
            'address'=>'balaju',

        ]);
    }
}
