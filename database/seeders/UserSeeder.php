<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'name'=>'Sumaj ST',
            'email'=>'sumajst@gmail.com',
            'password'=>'$2y$10$vv.HvUrGoDre8hQSdUMdNe.c4UMhfQ3cMEe73En4L31Zjhbk3SbwC',
        ]);

        $admin = Role::create([
            'name'=>'Administrador',
            'description'=>'Administrador tiene privilegios de todo el sistema',
        ]);
        $permisos = Permission::pluck('id', 'id')->all();
        
        $admin->syncPermissions($permisos);

        $user->assignRole([$admin->id]);  
    }
}
