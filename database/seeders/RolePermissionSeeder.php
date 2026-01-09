<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;
class RolePermissionSeeder extends Seeder
{
      public function run()
    {
        $admin = Role::where('name', 'admin')->first();
       
        // الصلاحيات للـ admin
        $allPermissions = Permission::all();
        $admin->permissions()->sync($allPermissions->pluck('id'));

      
    }
}
