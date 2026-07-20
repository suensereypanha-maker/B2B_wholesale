<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed roles and permissions first
        $this->call(RolesAndPermissionsSeeder::class);

        // 2. Seed a Super Admin user
        $superAdminRole = Role::where('slug', 'super-admin')->first();

        User::updateOrCreate(
            ['email' => 'admin@wholesale.com'],
            [
                'name'      => 'Super Admin',
                'role_id'   => $superAdminRole?->id,
                'is_active' => true,
                'password'  => Hash::make('password'),
            ]
        );

        // 3. Seed additional demo users
        $roles = Role::pluck('id', 'slug');

        $demoUsers = [
            ['name' => 'John Manager',    'email' => 'manager@wholesale.com',   'role_slug' => 'manager'],
            ['name' => 'Sara Sales',      'email' => 'sales@wholesale.com',     'role_slug' => 'sales-agent'],
            ['name' => 'Tom Warehouse',   'email' => 'warehouse@wholesale.com', 'role_slug' => 'warehouse-staff'],
            ['name' => 'Alice Viewer',    'email' => 'viewer@wholesale.com',    'role_slug' => 'viewer'],
        ];

        foreach ($demoUsers as $u) {
            User::updateOrCreate(
                ['email' => $u['email']],
                [
                    'name'      => $u['name'],
                    'role_id'   => $roles[$u['role_slug']] ?? null,
                    'is_active' => true,
                    'password'  => Hash::make('password'),
                ]
            );
        }

        $this->command->info('✅  Demo users seeded. Login: admin@wholesale.com / password');
    }
}

