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
        $roles = [
            'Admin',
            'Doctor',
            'Secretary',
            'Patient'
        ];

        foreach ($roles as $role) {
            $data = Role::create(['name' => $role]);
        }
    }
}
