<?php

namespace Database\Seeders;

use App\Models\Applikasi\SettingAkun;
use App\Models\Applikasi\SettingAplikasi;
use App\Models\Applikasi\SettingBiaya;
use App\Models\Router\Router;
use App\Models\User;
use App\Models\Wilayah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    {

        SettingAplikasi::create(
            [
                'app_nama' => '-',
                'app_brand' => '-',
                'app_alamat' => '-',
            ]
        );


        User::create([
            'id' => '1',
            'name' => 'adminitrator',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'ktp' => '0',
            'hp' => '0',
            'alamat_lengkap' => '-',
            'status_user' => 'Aktif',
            'password' => Hash::make('1234'),
        ]);

        $role_admin = Role::updateorcreate(
            ['name' => 'admin'],
            ['guard_name' => 'web'],
            ['id' => '1'],
            ['name' => 'admin'],
            ['guard_name' => 'web']
        );
        $permission = Permission::updateorcreate(
            ['name' => 'admin'],
            ['guard_name' => 'web'],
            ['id' => '1'],
            ['name' => 'admin'],
            ['guard_name' => 'web'],
        );

        $role_admin->givePermissionTo($permission);

        $admin = User::find(1);

        $admin->assignRole('admin');
    }
}
