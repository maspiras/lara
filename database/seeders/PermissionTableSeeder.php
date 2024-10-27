<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
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
            

         ];
         
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
