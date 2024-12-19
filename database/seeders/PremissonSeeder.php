<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PremissonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Gán role Super Admin cho User có id = 5
          $user = \App\Models\User::find(5);

          if ($user) {
             // dd($user);
              $user->assignRole('super_admin');  // Gán vai trò Super Admin cho người dùng
          }
    }
}
