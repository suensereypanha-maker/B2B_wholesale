<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display the supplier reports page.
     */
    public function index()
    {
        $user = auth('web')->user() ?? auth()->user();

        // Mock Supplier Statistics (specific to this supplier)
        $stats = [
            'listed_products'   => 12,
            'active_orders'     => 3,
            'fulfilled_orders'  => 48,
            'sales_revenue'     => 14200,
        ];

        // Mock Supplier Monthly Sales Chart Data
        $monthlyEarningsData = [
            'labels'   => ['Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            'earnings' => [850, 920, 780, 1200, 1450, 950, 1100, 1300, 1250, 1500, 1380, 1520],
            'orders'   => [3, 4, 3, 5, 6, 4, 5, 5, 4, 6, 5, 6],
        ];

        // Mock Performance Metrics
        $performance = [
            'fulfillment_rate' => 97.8, // percentage
            'avg_lead_time'    => '1.8 Days',
            'return_rate'      => 0.4, // percentage
        ];

        // Mock Popular Items for this Supplier
        $popularItems = [
            [
                'name'       => 'Industrial Steel Bolt Set (M10×50)',
                'sku'        => 'SKU-BS-1050',
                'sold'       => 420,
                'revenue'    => '$2,940.00',
                'stock'      => 120,
            ],
            [
                'name'       => 'Premium Work Gloves (XL)',
                'sku'        => 'SKU-WG-XL',
                'sold'       => 280,
                'revenue'    => '$1,400.00',
                'stock'      => 350,
            ],
            [
                'name'       => 'Heavy-Duty PVC Pipe 4"',
                'sku'        => 'SKU-PVC-400',
                'sold'       => 150,
                'revenue'    => '$975.00',
                'stock'      => 80,
            ],
        ];

        return view('supplier.reports', compact('user', 'stats', 'monthlyEarningsData', 'performance', 'popularItems'));
    }
}
