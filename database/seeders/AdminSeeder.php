<?php

namespace Database\Seeders;

use App\Models\dashboard\Admin;
use App\Models\dashboard\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $first_role_id = Role::first()->id;
        $admin = Admin::create([
            "name" => "mohamed",
            "email" => "mr319242@gmail.com",
            // 'phone' => '01000000000',
            "password" => bcrypt("11111111"),
            // 'type' => 'admin',
            'role_id' => $first_role_id
        ]);
    }
}
