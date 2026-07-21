<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Brand::truncate();
        Schema::enableForeignKeyConstraints();

        $brands = [
            [
                'name' => 'Intel',
                'website' => 'https://www.intel.com',
                'description' => 'World leader in semiconductor design, CPUs, and server processors.',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'AMD',
                'website' => 'https://www.amd.com',
                'description' => 'High-performance computing, Ryzen CPUs, Radeon GPUs, and EPYC server processors.',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'NVIDIA',
                'website' => 'https://www.nvidia.com',
                'description' => 'Leader in GPU graphics cards, AI hardware, and accelerated computing.',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'ASUS',
                'website' => 'https://www.asus.com',
                'description' => 'Global motherboard, laptop, graphics card, and networking manufacturer.',
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'MSI',
                'website' => 'https://www.msi.com',
                'description' => 'Premium gaming laptops, motherboards, GPUs, and desktop components.',
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Gigabyte',
                'website' => 'https://www.gigabyte.com',
                'description' => 'High quality motherboards, graphics cards, and server solutions.',
                'is_featured' => false,
                'sort_order' => 6,
            ],
            [
                'name' => 'Corsair',
                'website' => 'https://www.corsair.com',
                'description' => 'High-performance RAM, PC power supplies, cooling, cases, and gaming peripherals.',
                'is_featured' => true,
                'sort_order' => 7,
            ],
            [
                'name' => 'Kingston',
                'website' => 'https://www.kingston.com',
                'description' => 'Global memory module and SSD storage manufacturer.',
                'is_featured' => true,
                'sort_order' => 8,
            ],
            [
                'name' => 'Samsung',
                'website' => 'https://www.samsung.com',
                'description' => 'Leader in NVMe SSD storage, memory chips, and display monitors.',
                'is_featured' => true,
                'sort_order' => 9,
            ],
            [
                'name' => 'Western Digital',
                'website' => 'https://www.westerndigital.com',
                'description' => 'HDD and NVMe SSD storage solutions for desktop, NAS, and data center.',
                'is_featured' => false,
                'sort_order' => 10,
            ],
            [
                'name' => 'Logitech',
                'website' => 'https://www.logitech.com',
                'description' => 'World class computer keyboards, mice, webcams, and audio gear.',
                'is_featured' => true,
                'sort_order' => 11,
            ],
            [
                'name' => 'TP-Link',
                'website' => 'https://www.tp-link.com',
                'description' => 'Reliable Wi-Fi routers, network switches, and networking accessories.',
                'is_featured' => false,
                'sort_order' => 12,
            ],
            [
                'name' => 'Dell',
                'website' => 'https://www.dell.com',
                'description' => 'Enterprise laptops, desktop workstations, monitors, and servers.',
                'is_featured' => false,
                'sort_order' => 13,
            ],
            [
                'name' => 'HP',
                'website' => 'https://www.hp.com',
                'description' => 'Personal computers, laptops, laser printers, and IT hardware.',
                'is_featured' => false,
                'sort_order' => 14,
            ],
        ];

        foreach ($brands as $b) {
            Brand::create([
                'name'        => $b['name'],
                'slug'        => Str::slug($b['name']),
                'website'     => $b['website'],
                'description' => $b['description'],
                'is_active'   => true,
                'is_featured' => $b['is_featured'],
                'sort_order'  => $b['sort_order'],
            ]);
        }

        $this->command->info('✅  Computer hardware Brands seeded successfully.');
    }
}
