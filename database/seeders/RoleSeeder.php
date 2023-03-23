<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        Permission::create(['name' => 'view posts']);

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('view posts');
        
        Role::create(['name' => 'petani']);
        Role::create(['name' => 'penjual']);

        $user = User::create([
            'username'=>'gunz',
            'nama_panggilan'=>'Guntur',
            'password'=>password_hash('123',PASSWORD_DEFAULT),
            'email'=>"gunz@mail.com"
        ]);

        $user->assignRole($admin);
    }
}
