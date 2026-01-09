<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
   
     public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();

        $admin = User::firstOrCreate(
            ['email' => 'admin@shop.com' ,  'phone' => '0500000000',
                'name' => 'Admin User',
            'address' => 'Admin Address',
            'type' => 'admin',],
            
            [
                'name' => 'Admin',
                'password' => bcrypt('password123')
            ]
        );

        $admin->roles()->syncWithoutDetaching([$adminRole->id]);
    }
}
