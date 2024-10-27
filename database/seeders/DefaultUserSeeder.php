<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Mark Aspiras', 
            'email' => 'maspiras@gmail.com',
            'password' => Hash::make('mark90143')
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'name' => 'Izah Aspiras', 
            'email' => 'izah@yahoo.com',
            'password' => Hash::make('mark90143')
        ]);
        $admin->assignRole('Admin');

        // Creating Product Manager User
        $hotelManager = User::create([
            'name' => 'Abdul Muqeet', 
            'email' => 'muqeet@allphptricks.com',
            'password' => Hash::make('abdul1234')
        ]);
        $hotelManager->assignRole('Hotel Manager');

        // Creating Application User
        $user = User::create([
            'name' => 'Zeus Aspiras', 
            'email' => 'zeus@gmail.com',
            'password' => Hash::make('zeus1234')
        ]);
        $user->assignRole('User');
    
    }
}
