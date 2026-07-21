<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Product::truncate();
        Schema::enableForeignKeyConstraints();

        // Fetch reference models
        $cpuCategory   = Category::where('name', 'CPU')->first() ?: Category::where('name', 'like', '%CPU%')->first();
        $gpuCategory   = Category::where('name', 'Graphics Card')->first() ?: Category::where('name', 'GPU')->first();
        $ssdCategory   = Category::where('name', 'SSD')->first();
        $ramCategory   = Category::where('name', 'RAM')->first();
        $mbCategory    = Category::where('name', 'Motherboard')->first();

        $intelBrand    = Brand::where('name', 'Intel')->first();
        $nvidiaBrand   = Brand::where('name', 'NVIDIA')->first();
        $samsungBrand  = Brand::where('name', 'Samsung')->first();
        $corsairBrand  = Brand::where('name', 'Corsair')->first();
        $asusBrand     = Brand::where('name', 'ASUS')->first();

        $techSupply    = Supplier::where('company_name', 'TechSupply Global Ltd.')->first();
        $apexMemory    = Supplier::where('company_name', 'Apex Memory & Storage Co.')->first();
        $nexusComp     = Supplier::where('company_name', 'Nexus Wholesale Components')->first();

        $productsData = [
            [
                'name'              => 'Intel Core i9-14900K Desktop Processor 24 Cores',
                'sku'               => 'PROD-CPU-14900K',
                'category_id'       => $cpuCategory?->id,
                'brand_id'          => $intelBrand?->id,
                'supplier_id'       => $techSupply?->id,
                'short_description' => 'Flagship 24-core (8P + 16E) desktop processor up to 6.0 GHz.',
                'description'       => 'The Intel Core i9-14900K features 24 cores and 32 threads, unlocked for overclocking with LGA1700 socket support. Ideal for extreme gaming and workstation computing.',
                'cost_price'        => 480.00,
                'wholesale_price'   => 549.00,
                'retail_price'      => 599.00,
                'min_order_qty'     => 5,
                'stock_qty'         => 150,
                'is_featured'       => true,
            ],
            [
                'name'              => 'NVIDIA GeForce RTX 4090 24GB GDDR6X Graphics Card',
                'sku'               => 'PROD-GPU-RTX4090',
                'category_id'       => $gpuCategory?->id,
                'brand_id'          => $nvidiaBrand?->id,
                'supplier_id'       => $nexusComp?->id,
                'short_description' => 'Ultimate GeForce GPU for extreme 4K gaming and AI compute workloads.',
                'description'       => 'Powered by the ultra-efficient NVIDIA Ada Lovelace architecture, 24GB GDDR6X memory, DLSS 3 frame generation, and 3rd gen RT cores.',
                'cost_price'        => 1420.00,
                'wholesale_price'   => 1599.00,
                'retail_price'      => 1799.00,
                'min_order_qty'     => 2,
                'stock_qty'         => 45,
                'is_featured'       => true,
            ],
            [
                'name'              => 'Samsung 990 PRO 2TB PCIe 4.0 NVMe M.2 SSD',
                'sku'               => 'PROD-SSD-SAM990-2TB',
                'category_id'       => $ssdCategory?->id,
                'brand_id'          => $samsungBrand?->id,
                'supplier_id'       => $apexMemory?->id,
                'short_description' => 'Ultra-fast NVMe M.2 SSD with up to 7450 MB/s sequential read speeds.',
                'description'       => 'Samsung 990 PRO offers top PCIe 4.0 speeds, nickel coating thermal control, and high endurance for data centers, gaming, and 3D rendering.',
                'cost_price'        => 130.00,
                'wholesale_price'   => 165.00,
                'retail_price'      => 199.00,
                'min_order_qty'     => 10,
                'stock_qty'         => 300,
                'is_featured'       => true,
            ],
            [
                'name'              => 'Corsair Vengeance RGB 32GB (2x16GB) DDR5 6000MHz CL36',
                'sku'               => 'PROD-RAM-COR32GB-D5',
                'category_id'       => $ramCategory?->id,
                'brand_id'          => $corsairBrand?->id,
                'supplier_id'       => $apexMemory?->id,
                'short_description' => 'High-frequency DDR5 Desktop Memory Kit with dynamic ten-zone RGB lighting.',
                'description'       => 'Delivers higher frequencies, greater capacities, and better performance for latest Intel & AMD motherboards. Integrated onboard voltage regulation for XMP 3.0.',
                'cost_price'        => 88.00,
                'wholesale_price'   => 115.00,
                'retail_price'      => 139.00,
                'min_order_qty'     => 5,
                'stock_qty'         => 200,
                'is_featured'       => false,
            ],
            [
                'name'              => 'ASUS ROG Strix Z790-E Gaming WiFi ATX Motherboard',
                'sku'               => 'PROD-MB-ASUS-Z790E',
                'category_id'       => $mbCategory?->id,
                'brand_id'          => $asusBrand?->id,
                'supplier_id'       => $techSupply?->id,
                'short_description' => 'Premium LGA1700 motherboard with PCIe 5.0, 18+1 power stages, and WiFi 6E.',
                'description'       => 'Engineered for 13th & 14th Gen Intel Core processors. Features 5x M.2 slots, USB 3.2 Gen 2x2 Type-C, AI Overclocking, and SupremeFX audio.',
                'cost_price'        => 360.00,
                'wholesale_price'   => 429.00,
                'retail_price'      => 499.00,
                'min_order_qty'     => 3,
                'stock_qty'         => 80,
                'is_featured'       => true,
            ],
        ];

        foreach ($productsData as $p) {
            Product::create([
                'name'              => $p['name'],
                'sku'               => $p['sku'],
                'slug'              => Str::slug($p['name']),
                'category_id'       => $p['category_id'] ?: Category::first()?->id,
                'brand_id'          => $p['brand_id'],
                'supplier_id'       => $p['supplier_id'],
                'short_description' => $p['short_description'],
                'description'       => $p['description'],
                'cost_price'        => $p['cost_price'],
                'wholesale_price'   => $p['wholesale_price'],
                'retail_price'      => $p['retail_price'],
                'min_order_qty'     => $p['min_order_qty'],
                'stock_qty'         => $p['stock_qty'],
                'is_active'         => true,
                'is_featured'       => $p['is_featured'],
            ]);
        }

        $this->command->info('✅  5 Sample B2B Computer Hardware Products seeded successfully.');
    }
}
