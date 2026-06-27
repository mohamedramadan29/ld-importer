<?php

namespace Database\Seeders;

use App\Models\dashboard\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permisions = [];
        foreach (config('permissions') as $key => $value) {
            $permisions[] = $key;
        }
        if (Role::count() === 0) {
            Role::create([
                'role' => 'مدير',
                'permission' => json_encode($permisions)
            ]);
        }
    }
}
