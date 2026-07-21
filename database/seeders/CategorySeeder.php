<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate categories table safely to reset with exact user category list
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        $categoriesData = [
            [
                'name' => 'Computer Components',
                'description' => 'Essential hardware components for desktop and server builds.',
                'icon' => 'bi-cpu-fill',
                'sort_order' => 1,
                'subcategories' => [
                    ['name' => 'CPU', 'description' => 'Central Processing Units from Intel and AMD.', 'icon' => 'bi-cpu', 'sort_order' => 1],
                    ['name' => 'Motherboard', 'description' => 'Main system boards for all form factors.', 'icon' => 'bi-motherboard', 'sort_order' => 2],
                    ['name' => 'RAM', 'description' => 'DDR4 and DDR5 system memory modules.', 'icon' => 'bi-memory', 'sort_order' => 3],
                    ['name' => 'Graphics Card', 'description' => 'Graphics processing units and video cards.', 'icon' => 'bi-gpu-card', 'sort_order' => 4],
                    ['name' => 'SSD', 'description' => 'M.2 NVMe and SATA Solid State Drives.', 'icon' => 'bi-device-ssd', 'sort_order' => 5],
                    ['name' => 'HDD', 'description' => 'Internal 3.5" and 2.5" Hard Disk Drives.', 'icon' => 'bi-hdd-fill', 'sort_order' => 6],
                    ['name' => 'Power Supply', 'description' => 'Power Supply Units with various wattage ratings.', 'icon' => 'bi-lightning-charge-fill', 'sort_order' => 7],
                    ['name' => 'CPU Cooler', 'description' => 'Air heatsinks and Liquid AIO cooling solutions.', 'icon' => 'bi-fan', 'sort_order' => 8],
                    ['name' => 'Computer Case', 'description' => 'Desktop PC cases and server chassis.', 'icon' => 'bi-pc-display-horizontal', 'sort_order' => 9],
                ],
            ],
            [
                'name' => 'Laptops',
                'description' => 'Portable notebooks, ultrabooks, and high-performance gaming laptops.',
                'icon' => 'bi-laptop',
                'sort_order' => 2,
                'subcategories' => [
                    ['name' => 'Business', 'description' => 'Reliable enterprise notebooks for office and remote work.', 'icon' => 'bi-briefcase-fill', 'sort_order' => 1],
                    ['name' => 'Gaming', 'description' => 'High-performance laptops equipped with dedicated GPUs.', 'icon' => 'bi-controller', 'sort_order' => 2],
                    ['name' => 'Ultrabook', 'description' => 'Thin, lightweight, and long battery life laptops.', 'icon' => 'bi-laptop-fill', 'sort_order' => 3],
                ],
            ],
            [
                'name' => 'Monitors',
                'description' => 'Desktop displays, gaming monitors, and high-resolution panels.',
                'icon' => 'bi-display',
                'sort_order' => 3,
                'subcategories' => [
                    ['name' => 'Office', 'description' => 'Full HD and 2K ergonomic monitors for productivity.', 'icon' => 'bi-display-fill', 'sort_order' => 1],
                    ['name' => 'Gaming', 'description' => 'High refresh rate (144Hz+) and low response time monitors.', 'icon' => 'bi-badge-ad-fill', 'sort_order' => 2],
                    ['name' => 'Curved', 'description' => 'Immersive curved screen displays.', 'icon' => 'bi-aspect-ratio-fill', 'sort_order' => 3],
                ],
            ],
            [
                'name' => 'Peripherals',
                'description' => 'Input devices, audio gear, and desktop accessories.',
                'icon' => 'bi-keyboard-fill',
                'sort_order' => 4,
                'subcategories' => [
                    ['name' => 'Keyboard', 'description' => 'Mechanical, membrane, and wireless keyboards.', 'icon' => 'bi-keyboard', 'sort_order' => 1],
                    ['name' => 'Mouse', 'description' => 'Optical, ergonomic, and gaming mice.', 'icon' => 'bi-mouse', 'sort_order' => 2],
                    ['name' => 'Webcam', 'description' => 'HD and 4K video conference cameras.', 'icon' => 'bi-camera-video', 'sort_order' => 3],
                    ['name' => 'Headset', 'description' => 'Noise-canceling headsets and gaming headphones.', 'icon' => 'bi-headphones', 'sort_order' => 4],
                    ['name' => 'Speakers', 'description' => 'Desktop speakers and soundbar systems.', 'icon' => 'bi-speaker', 'sort_order' => 5],
                ],
            ],
            [
                'name' => 'Networking',
                'description' => 'Enterprise and home networking equipment.',
                'icon' => 'bi-router-fill',
                'sort_order' => 5,
                'subcategories' => [
                    ['name' => 'Router', 'description' => 'Wi-Fi 6 routers and dual-band gateways.', 'icon' => 'bi-router', 'sort_order' => 1],
                    ['name' => 'Switch', 'description' => 'Gigabit PoE and managed network switches.', 'icon' => 'bi-hdd-rack', 'sort_order' => 2],
                    ['name' => 'Access Point', 'description' => 'Ceiling and outdoor wireless access points.', 'icon' => 'bi-wifi', 'sort_order' => 3],
                    ['name' => 'LAN Cable', 'description' => 'Cat6, Cat7 Ethernet patch cords and cable rolls.', 'icon' => 'bi-ethernet', 'sort_order' => 4],
                ],
            ],
            [
                'name' => 'Printers & Scanners',
                'description' => 'Office printing, scanning, and multifunction devices.',
                'icon' => 'bi-printer-fill',
                'sort_order' => 6,
                'subcategories' => [
                    ['name' => 'Laser Printer', 'description' => 'Monochrome and color high-speed laser printers.', 'icon' => 'bi-printer', 'sort_order' => 1],
                    ['name' => 'Inkjet Printer', 'description' => 'Continuous ink tank and color inkjet printers.', 'icon' => 'bi-printer-fill', 'sort_order' => 2],
                    ['name' => 'Scanner', 'description' => 'Flatbed and high-speed document scanners.', 'icon' => 'bi-scanner', 'sort_order' => 3],
                ],
            ],
            [
                'name' => 'Storage',
                'description' => 'Portable drives, flash memory, and removable storage.',
                'icon' => 'bi-hdd-network',
                'sort_order' => 7,
                'subcategories' => [
                    ['name' => 'External HDD', 'description' => 'Portable 2.5" and desktop external hard drives.', 'icon' => 'bi-hdd', 'sort_order' => 1],
                    ['name' => 'External SSD', 'description' => 'Rugged, high-speed portable solid state drives.', 'icon' => 'bi-device-ssd-fill', 'sort_order' => 2],
                    ['name' => 'USB Flash Drive', 'description' => 'USB 3.0 and Type-C flash drives.', 'icon' => 'bi-usb-drive', 'sort_order' => 3],
                    ['name' => 'Memory Card', 'description' => 'MicroSD and SD cards for devices.', 'icon' => 'bi-sd-card', 'sort_order' => 4],
                ],
            ],
            [
                'name' => 'Accessories',
                'description' => 'Display cables, hubs, adapters, and docking hardware.',
                'icon' => 'bi-plug-fill',
                'sort_order' => 8,
                'subcategories' => [
                    ['name' => 'HDMI Cable', 'description' => 'High-speed HDMI 2.1 and DisplayPort cables.', 'icon' => 'bi-hdmi', 'sort_order' => 1],
                    ['name' => 'USB Hub', 'description' => 'Multi-port Type-C and USB 3.0 expansion hubs.', 'icon' => 'bi-usb-c', 'sort_order' => 2],
                    ['name' => 'Adapter', 'description' => 'Display, audio, and power conversion adapters.', 'icon' => 'bi-plugin', 'sort_order' => 3],
                    ['name' => 'Docking Station', 'description' => 'Dual and triple display laptop docking stations.', 'icon' => 'bi-pc-horizontal', 'sort_order' => 4],
                ],
            ],
            [
                'name' => 'Power & Backup',
                'description' => 'Uninterruptible power supplies, surge protectors, and strips.',
                'icon' => 'bi-battery-charging',
                'sort_order' => 9,
                'subcategories' => [
                    ['name' => 'UPS', 'description' => 'Uninterruptible Power Supplies for PCs and servers.', 'icon' => 'bi-lightning-fill', 'sort_order' => 1],
                    ['name' => 'Power Strip', 'description' => 'Multi-outlet extension power strips.', 'icon' => 'bi-power', 'sort_order' => 2],
                    ['name' => 'Surge Protector', 'description' => 'Surge protected power boards with USB ports.', 'icon' => 'bi-shield-check', 'sort_order' => 3],
                ],
            ],
            [
                'name' => 'Software',
                'description' => 'Operating systems, office suites, and security software.',
                'icon' => 'bi-disc-fill',
                'sort_order' => 10,
                'subcategories' => [
                    ['name' => 'Windows', 'description' => 'Windows 11 Home, Pro, and Windows Server licenses.', 'icon' => 'bi-windows', 'sort_order' => 1],
                    ['name' => 'Microsoft Office', 'description' => 'Microsoft 365 Home, Business, and Office Home & Business.', 'icon' => 'bi-file-earmark-word-fill', 'sort_order' => 2],
                    ['name' => 'Antivirus', 'description' => 'Internet Security and Endpoint protection software.', 'icon' => 'bi-shield-lock-fill', 'sort_order' => 3],
                ],
            ],
        ];

        foreach ($categoriesData as $parentData) {
            $parent = Category::create([
                'parent_id' => null,
                'name' => $parentData['name'],
                'slug' => Str::slug($parentData['name']),
                'description' => $parentData['description'],
                'icon' => $parentData['icon'],
                'sort_order' => $parentData['sort_order'],
                'is_active' => true,
            ]);

            if (!empty($parentData['subcategories'])) {
                foreach ($parentData['subcategories'] as $subData) {
                    $subSlug = Str::slug($subData['name']);
                    
                    // If slug exists, prefix with parent category slug
                    if (Category::where('slug', $subSlug)->exists()) {
                        $subSlug = Str::slug($parentData['name'] . '-' . $subData['name']);
                    }

                    Category::create([
                        'parent_id' => $parent->id,
                        'name' => $subData['name'],
                        'slug' => $subSlug,
                        'description' => $subData['description'],
                        'icon' => $subData['icon'],
                        'sort_order' => $subData['sort_order'],
                        'is_active' => true,
                    ]);
                }
            }
        }

        $this->command->info('✅  Exact Computer & IT Hardware Categories seeded successfully.');
    }
}
