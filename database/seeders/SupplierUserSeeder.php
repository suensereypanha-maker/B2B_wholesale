<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SupplierUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supplierRole = Role::where('slug', 'supplier')->first();

        if (!$supplierRole) {
            return;
        }

        $suppliersData = [
            [
                'email'        => 'techsupply@wholesale.com',
                'name'         => 'TechSupply Global Admin',
                'company_name' => 'TechSupply Global Ltd.',
                'contact_name' => 'Michael Chen',
                'phone'        => '+1 (555) 019-2831',
                'address'      => '742 Evergreen Terrace, Silicon Valley, CA 94025',
                'is_active'    => true,
            ],
            [
                'email'        => 'apexmemory@wholesale.com',
                'name'         => 'Apex Memory Admin',
                'company_name' => 'Apex Memory & Storage Co.',
                'contact_name' => 'David Miller',
                'phone'        => '+1 (555) 839-1029',
                'address'      => '1088 Semiconductor Way, Austin, TX 78701',
                'is_active'    => true,
            ],
            [
                'email'        => 'nexus@wholesale.com',
                'name'         => 'Nexus Components Admin',
                'company_name' => 'Nexus Wholesale Components',
                'contact_name' => 'Elena Rostova',
                'phone'        => '+49 30 9283 102',
                'address'      => 'Industriestrasse 42, 10115 Berlin, Germany',
                'is_active'    => true,
            ],
        ];

        foreach ($suppliersData as $s) {
            // 1. Create or update User with Role ID 7 ('supplier')
            $user = User::updateOrCreate(
                ['email' => $s['email']],
                [
                    'name'      => $s['name'],
                    'role_id'   => $supplierRole->id,
                    'is_active' => $s['is_active'],
                    'password'  => Hash::make('password'),
                ]
            );

            // 2. Create or update Supplier profile linked to user_id
            Supplier::updateOrCreate(
                ['company_name' => $s['company_name']],
                [
                    'user_id'      => $user->id,
                    'contact_name' => $s['contact_name'],
                    'email'        => $s['email'],
                    'phone'        => $s['phone'],
                    'address'      => $s['address'],
                    'is_active'    => $s['is_active'],
                ]
            );
        }

        $this->command->info('✅  Supplier users (Role ID 7) seeded successfully. Login: techsupply@wholesale.com / password');
    }
}
