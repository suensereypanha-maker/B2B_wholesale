<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // ─── Core Statistics ───────────────────────────────────────────
        $dashboard = [
            'total_products'    => 1_250,
            'total_categories'  => 28,
            'total_suppliers'   => 16,
            'total_customers'   => 420,
            'total_orders'      => 95,
            'today_sales'       => 3_200,
            'monthly_sales'     => 56_000,
            'low_stock'         => 18,
            'pending_orders'    => 12,
            'total_revenue'     => 128_400,
        ];

        // ─── Growth Percentages (vs previous period) ───────────────────
        $growth = [
            'products'    => ['value' => +8.4,  'trend' => 'up'],
            'categories'  => ['value' => +2.1,  'trend' => 'up'],
            'customers'   => ['value' => +12.7, 'trend' => 'up'],
            'suppliers'   => ['value' => -1.5,  'trend' => 'down'],
            'orders'      => ['value' => +18.3, 'trend' => 'up'],
            'revenue'     => ['value' => +22.6, 'trend' => 'up'],
            'low_stock'   => ['value' => +5.0,  'trend' => 'up'],
            'pending'     => ['value' => -6.8,  'trend' => 'down'],
        ];

        // ─── Recent Orders ─────────────────────────────────────────────
        $recentOrders = [
            [
                'id'         => '#ORD-10041',
                'customer'   => 'Pacific Retail Co.',
                'avatar'     => 'PR',
                'color'      => '#2563EB',
                'items'      => 14,
                'total'      => '$4,320.00',
                'status'     => 'completed',
                'date'       => '19 Jul 2026',
                'payment'    => 'Bank Transfer',
            ],
            [
                'id'         => '#ORD-10040',
                'customer'   => 'Metro Supplies Ltd.',
                'avatar'     => 'MS',
                'color'      => '#7C3AED',
                'items'      => 7,
                'total'      => '$1,875.50',
                'status'     => 'processing',
                'date'       => '19 Jul 2026',
                'payment'    => 'Credit Card',
            ],
            [
                'id'         => '#ORD-10039',
                'customer'   => 'Global Traders Inc.',
                'avatar'     => 'GT',
                'color'      => '#059669',
                'items'      => 22,
                'total'      => '$8,910.00',
                'status'     => 'pending',
                'date'       => '18 Jul 2026',
                'payment'    => 'Net-30 Terms',
            ],
            [
                'id'         => '#ORD-10038',
                'customer'   => 'StarMart Group',
                'avatar'     => 'SM',
                'color'      => '#D97706',
                'items'      => 5,
                'total'      => '$620.00',
                'status'     => 'shipped',
                'date'       => '18 Jul 2026',
                'payment'    => 'Bank Transfer',
            ],
            [
                'id'         => '#ORD-10037',
                'customer'   => 'Nordic Wholesale AB',
                'avatar'     => 'NW',
                'color'      => '#DC2626',
                'items'      => 9,
                'total'      => '$2,105.75',
                'status'     => 'cancelled',
                'date'       => '17 Jul 2026',
                'payment'    => 'Credit Card',
            ],
            [
                'id'         => '#ORD-10036',
                'customer'   => 'Eastview Distributors',
                'avatar'     => 'ED',
                'color'      => '#0891B2',
                'items'      => 18,
                'total'      => '$5,430.00',
                'status'     => 'completed',
                'date'       => '17 Jul 2026',
                'payment'    => 'Net-30 Terms',
            ],
        ];

        // ─── Top Selling Products ──────────────────────────────────────
        $topProducts = [
            [
                'name'       => 'Industrial Steel Bolt Set (M10×50)',
                'sku'        => 'SKU-BS-1050',
                'category'   => 'Hardware',
                'sold'       => 3_420,
                'revenue'    => '$24,150',
                'stock'      => 480,
                'trend'      => '+14.2%',
                'trend_dir'  => 'up',
            ],
            [
                'name'       => 'Heavy-Duty PVC Pipe 4"',
                'sku'        => 'SKU-PVC-400',
                'category'   => 'Plumbing',
                'sold'       => 2_890,
                'revenue'    => '$18,785',
                'stock'      => 215,
                'trend'      => '+9.8%',
                'trend_dir'  => 'up',
            ],
            [
                'name'       => 'Premium Work Gloves (XL)',
                'sku'        => 'SKU-WG-XL',
                'category'   => 'Safety',
                'sold'       => 2_310,
                'revenue'    => '$11,550',
                'stock'      => 1_200,
                'trend'      => '+22.3%',
                'trend_dir'  => 'up',
            ],
            [
                'name'       => 'LED Warehouse Light 200W',
                'sku'        => 'SKU-LED-200',
                'category'   => 'Electrical',
                'sold'       => 1_870,
                'revenue'    => '$33,660',
                'stock'      => 95,
                'trend'      => '+6.1%',
                'trend_dir'  => 'up',
            ],
            [
                'name'       => 'Hydraulic Pallet Jack 3T',
                'sku'        => 'SKU-HPJ-3T',
                'category'   => 'Equipment',
                'sold'       => 342,
                'revenue'    => '$44,460',
                'stock'      => 28,
                'trend'      => '-3.5%',
                'trend_dir'  => 'down',
            ],
        ];

        // ─── Low Stock Products ────────────────────────────────────────
        $lowStockProducts = [
            [
                'name'      => 'Hydraulic Pallet Jack 3T',
                'sku'       => 'SKU-HPJ-3T',
                'category'  => 'Equipment',
                'stock'     => 28,
                'min_stock' => 50,
                'status'    => 'critical',
            ],
            [
                'name'      => 'LED Warehouse Light 200W',
                'sku'       => 'SKU-LED-200',
                'category'  => 'Electrical',
                'stock'     => 95,
                'min_stock' => 100,
                'status'    => 'low',
            ],
            [
                'name'      => 'Safety Helmet (White)',
                'sku'       => 'SKU-SH-W',
                'category'  => 'Safety',
                'stock'     => 42,
                'min_stock' => 150,
                'status'    => 'critical',
            ],
            [
                'name'      => 'Industrial Drill Bit Set',
                'sku'       => 'SKU-DB-SET',
                'category'  => 'Tools',
                'stock'     => 67,
                'min_stock' => 80,
                'status'    => 'low',
            ],
            [
                'name'      => 'Fire Extinguisher 5kg',
                'sku'       => 'SKU-FE-5K',
                'category'  => 'Safety',
                'stock'     => 15,
                'min_stock' => 60,
                'status'    => 'critical',
            ],
        ];

        // ─── Monthly Sales Chart Data (last 12 months) ─────────────────
        $monthlySalesData = [
            'labels'   => ['Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            'revenue'  => [38200, 42500, 39800, 55000, 61200, 47800, 43100, 52300, 58700, 63400, 51200, 56000],
            'orders'   => [62, 71, 65, 88, 97, 75, 68, 83, 91, 102, 80, 95],
        ];

        // ─── Order Status Distribution ──────────────────────────────────
        $orderStatusData = [
            'labels' => ['Completed', 'Processing', 'Pending', 'Shipped', 'Cancelled'],
            'values' => [45, 20, 15, 12, 8],
            'colors' => ['#22C55E', '#2563EB', '#F59E0B', '#0891B2', '#EF4444'],
        ];

        // ─── Revenue by Category ───────────────────────────────────────
        $revenueByCategoryData = [
            'labels' => ['Hardware', 'Electrical', 'Plumbing', 'Safety', 'Equipment', 'Tools'],
            'values' => [34200, 28500, 19800, 15400, 18700, 11800],
        ];

        // ─── Recent Activities ──────────────────────────────────────────
        $recentActivities = [
            [
                'icon'    => 'bi-plus-circle-fill',
                'color'   => 'success',
                'title'   => 'New order received',
                'desc'    => 'Pacific Retail Co. placed order #ORD-10041 for $4,320.00',
                'time'    => '2 min ago',
            ],
            [
                'icon'    => 'bi-person-plus-fill',
                'color'   => 'primary',
                'title'   => 'New customer registered',
                'desc'    => 'Nordic Wholesale AB completed registration and KYC verification',
                'time'    => '18 min ago',
            ],
            [
                'icon'    => 'bi-exclamation-triangle-fill',
                'color'   => 'warning',
                'title'   => 'Low stock alert',
                'desc'    => 'Fire Extinguisher 5kg is critically low — only 15 units remaining',
                'time'    => '45 min ago',
            ],
            [
                'icon'    => 'bi-truck',
                'color'   => 'info',
                'title'   => 'Shipment dispatched',
                'desc'    => 'Order #ORD-10038 has been dispatched via FastFreight Logistics',
                'time'    => '1 hr ago',
            ],
            [
                'icon'    => 'bi-x-circle-fill',
                'color'   => 'danger',
                'title'   => 'Order cancelled',
                'desc'    => 'Nordic Wholesale AB cancelled order #ORD-10037 — payment declined',
                'time'    => '3 hrs ago',
            ],
            [
                'icon'    => 'bi-arrow-repeat',
                'color'   => 'secondary',
                'title'   => 'Inventory restocked',
                'desc'    => 'Heavy-Duty PVC Pipe 4" restocked — 500 units added from SupplierOne',
                'time'    => '5 hrs ago',
            ],
            [
                'icon'    => 'bi-file-earmark-bar-graph-fill',
                'color'   => 'purple',
                'title'   => 'Monthly report generated',
                'desc'    => 'June 2026 financial report generated and emailed to Finance Team',
                'time'    => 'Yesterday',
            ],
        ];

        return view('admin.dashboard', compact(
            'dashboard',
            'growth',
            'recentOrders',
            'topProducts',
            'lowStockProducts',
            'monthlySalesData',
            'orderStatusData',
            'revenueByCategoryData',
            'recentActivities'
        ));
    }
}
