<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $hotelManager = Role::create(['name' => 'Hotel Manager']);
        $user = Role::create(['name' => 'User']);

        $admin->givePermissionTo([
            'user-create',
            'user-edit',
            'user-delete',
            'user-list',            
        ]);

        $hotelManager->givePermissionTo([
            'room-list',
            'room-create',
            'room-edit',
            'room-delete',
            'booking-edit',
            'booking-edit-rates',
            'booking-edit-pax',
            'booking-edit-dates',
            'booking-edit-description',
            'booking-edit-prepayment',
            'booking-edit-discount',
            'booking-list', 'booking-create', 'booking-delete',
        ]);

        $user->givePermissionTo([
            'room-view'
        ]);
    }
}
