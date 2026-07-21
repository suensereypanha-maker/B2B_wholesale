<?php

namespace Database\Seeders;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Supplier::truncate();
        Schema::enableForeignKeyConstraints();

        $supplierUser = User::whereHas('role', fn($q) => $q->where('slug', 'supplier'))->first();

        $suppliers = [
            [
                'company_name' => 'TechSupply Global Ltd.',
                'contact_name' => 'Michael Chen',
                'email'        => 'contact@techsupply-global.com',
                'phone'        => '+1 (555) 019-2831',
                'address'      => '742 Evergreen Terrace, Silicon Valley, CA 94025',
                'user_id'      => $supplierUser?->id,
            ],
            [
                'company_name' => 'Apex Memory & Storage Co.',
                'contact_name' => 'David Miller',
                'email'        => 'sales@apexmemory.com',
                'phone'        => '+1 (555) 839-1029',
                'address'      => '1088 Semiconductor Way, Austin, TX 78701',
                'user_id'      => null,
            ],
            [
                'company_name' => 'Nexus Wholesale Components',
                'contact_name' => 'Elena Rostova',
                'email'        => 'wholesale@nexuscomponents.de',
                'phone'        => '+49 30 9283 102',
                'address'      => 'Industriestrasse 42, 10115 Berlin, Germany',
                'user_id'      => null,
            ],
        ];

        foreach ($suppliers as $s) {
            Supplier::create([
                'company_name' => $s['company_name'],
                'contact_name' => $s['contact_name'],
                'email'        => $s['email'],
                'phone'        => $s['phone'],
                'address'      => $s['address'],
                'user_id'      => $s['user_id'],
                'is_active'    => true,
            ]);
        }

        $this->command->info('✅  B2B Suppliers seeded successfully.');
    }
}
