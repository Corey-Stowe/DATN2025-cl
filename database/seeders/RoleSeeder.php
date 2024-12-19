<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'member', 'employee','affiliate','employee_support','employee_stock_controller'];
        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'role_type' => $role
            ]);
        }

    }
}
