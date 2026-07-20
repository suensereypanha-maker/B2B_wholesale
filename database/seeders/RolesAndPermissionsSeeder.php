<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ─── 1. Create Roles ──────────────────────────────────────────
        $rolesData = [
            [
                'name'        => 'Super Admin',
                'slug'        => 'super-admin',
                'description' => 'Full system access. Can manage all features, users, roles, and permissions.',
                'color'       => '#2563EB',
                'is_system'   => true,
            ],
            [
                'name'        => 'Admin',
                'slug'        => 'admin',
                'description' => 'Administrative access. Can manage most features except system-level settings.',
                'color'       => '#7C3AED',
                'is_system'   => true,
            ],
            [
                'name'        => 'Manager',
                'slug'        => 'manager',
                'description' => 'Operations manager. Can approve orders, manage inventory, and view reports.',
                'color'       => '#059669',
                'is_system'   => false,
            ],
            [
                'name'        => 'Sales Agent',
                'slug'        => 'sales-agent',
                'description' => 'Sales team member. Can create and manage sales orders and customers.',
                'color'       => '#D97706',
                'is_system'   => false,
            ],
            [
                'name'        => 'Warehouse Staff',
                'slug'        => 'warehouse-staff',
                'description' => 'Warehouse operations. Can manage inventory, goods receipt, and dispatches.',
                'color'       => '#0891B2',
                'is_system'   => false,
            ],
            [
                'name'        => 'Viewer',
                'slug'        => 'viewer',
                'description' => 'Read-only access. Can view dashboard and reports but cannot make changes.',
                'color'       => '#6B7280',
                'is_system'   => false,
            ],
            [
                'name'        => 'Supplier',
                'slug'        => 'supplier',
                'description' => 'Supplier portal user. Can view product catalogs, manage pricing, and track purchase orders.',
                'color'       => '#DB2777', 
                'is_system'   => false,
            ],

        ];

        $roles = [];
        foreach ($rolesData as $data) {
            $roles[$data['slug']] = Role::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }

        // ─── 2. Create Permissions (grouped by module) ─────────────────
        $permissionsData = [

            // ── Dashboard ───────────────────────────
            ['name' => 'View Dashboard',   'slug' => 'dashboard.view',     'module' => 'dashboard',       'description' => 'Access the main admin dashboard'],
            ['name' => 'View Analytics',   'slug' => 'dashboard.analytics','module' => 'dashboard',       'description' => 'View detailed analytics and charts'],

            // ── Users ────────────────────────────────
            ['name' => 'View Users',       'slug' => 'users.view',         'module' => 'users',           'description' => 'View the user list and profiles'],
            ['name' => 'Create Users',     'slug' => 'users.create',       'module' => 'users',           'description' => 'Create new user accounts'],
            ['name' => 'Edit Users',       'slug' => 'users.edit',         'module' => 'users',           'description' => 'Update existing user information'],
            ['name' => 'Delete Users',     'slug' => 'users.delete',       'module' => 'users',           'description' => 'Permanently remove user accounts'],
            ['name' => 'Activate Users',   'slug' => 'users.activate',     'module' => 'users',           'description' => 'Enable or disable user accounts'],

            // ── Roles & Permissions ─────────────────
            ['name' => 'View Roles',       'slug' => 'roles.view',         'module' => 'roles',           'description' => 'View roles and their permission matrix'],
            ['name' => 'Create Roles',     'slug' => 'roles.create',       'module' => 'roles',           'description' => 'Create new custom roles'],
            ['name' => 'Edit Roles',       'slug' => 'roles.edit',         'module' => 'roles',           'description' => 'Modify role names and permissions'],
            ['name' => 'Delete Roles',     'slug' => 'roles.delete',       'module' => 'roles',           'description' => 'Remove non-system roles'],
            ['name' => 'Assign Roles',     'slug' => 'roles.assign',       'module' => 'roles',           'description' => 'Assign roles to users'],
            ['name' => 'View Permissions', 'slug' => 'permissions.view',   'module' => 'roles',           'description' => 'View the permissions list'],
            ['name' => 'Edit Permissions', 'slug' => 'permissions.edit',   'module' => 'roles',           'description' => 'Create and modify permissions'],

            // ── Products ─────────────────────────────
            ['name' => 'View Products',    'slug' => 'products.view',      'module' => 'products',        'description' => 'Browse the product catalog'],
            ['name' => 'Create Products',  'slug' => 'products.create',    'module' => 'products',        'description' => 'Add new products to the catalog'],
            ['name' => 'Edit Products',    'slug' => 'products.edit',      'module' => 'products',        'description' => 'Update product information and pricing'],
            ['name' => 'Delete Products',  'slug' => 'products.delete',    'module' => 'products',        'description' => 'Remove products from the catalog'],
            ['name' => 'Import Products',  'slug' => 'products.import',    'module' => 'products',        'description' => 'Bulk import products via CSV/Excel'],
            ['name' => 'Export Products',  'slug' => 'products.export',    'module' => 'products',        'description' => 'Export product data to CSV/Excel'],

            // ── Categories ───────────────────────────
            ['name' => 'View Categories',  'slug' => 'categories.view',    'module' => 'categories',      'description' => 'View product categories'],
            ['name' => 'Create Categories','slug' => 'categories.create',  'module' => 'categories',      'description' => 'Add new product categories'],
            ['name' => 'Edit Categories',  'slug' => 'categories.edit',    'module' => 'categories',      'description' => 'Update category details'],
            ['name' => 'Delete Categories','slug' => 'categories.delete',  'module' => 'categories',      'description' => 'Remove product categories'],

            // ── Brands ───────────────────────────────
            ['name' => 'View Brands',      'slug' => 'brands.view',        'module' => 'brands',          'description' => 'View product brands'],
            ['name' => 'Create Brands',    'slug' => 'brands.create',      'module' => 'brands',          'description' => 'Register new brands'],
            ['name' => 'Edit Brands',      'slug' => 'brands.edit',        'module' => 'brands',          'description' => 'Update brand information'],
            ['name' => 'Delete Brands',    'slug' => 'brands.delete',      'module' => 'brands',          'description' => 'Remove brands from the system'],

            // ── Suppliers ────────────────────────────
            ['name' => 'View Suppliers',   'slug' => 'suppliers.view',     'module' => 'suppliers',       'description' => 'Browse the supplier directory'],
            ['name' => 'Create Suppliers', 'slug' => 'suppliers.create',   'module' => 'suppliers',       'description' => 'Register new suppliers'],
            ['name' => 'Edit Suppliers',   'slug' => 'suppliers.edit',     'module' => 'suppliers',       'description' => 'Update supplier information'],
            ['name' => 'Delete Suppliers', 'slug' => 'suppliers.delete',   'module' => 'suppliers',       'description' => 'Remove suppliers from the system'],

            // ── Customers ────────────────────────────
            ['name' => 'View Customers',   'slug' => 'customers.view',     'module' => 'customers',       'description' => 'Browse the customer directory'],
            ['name' => 'Create Customers', 'slug' => 'customers.create',   'module' => 'customers',       'description' => 'Register new customers'],
            ['name' => 'Edit Customers',   'slug' => 'customers.edit',     'module' => 'customers',       'description' => 'Update customer information'],
            ['name' => 'Delete Customers', 'slug' => 'customers.delete',   'module' => 'customers',       'description' => 'Remove customer accounts'],

            // ── Purchase Orders ──────────────────────
            ['name' => 'View Purchase Orders',   'slug' => 'purchase-orders.view',   'module' => 'purchase_orders', 'description' => 'View incoming purchase orders'],
            ['name' => 'Create Purchase Orders', 'slug' => 'purchase-orders.create', 'module' => 'purchase_orders', 'description' => 'Place new purchase orders'],
            ['name' => 'Edit Purchase Orders',   'slug' => 'purchase-orders.edit',   'module' => 'purchase_orders', 'description' => 'Modify existing purchase orders'],
            ['name' => 'Delete Purchase Orders', 'slug' => 'purchase-orders.delete', 'module' => 'purchase_orders', 'description' => 'Cancel and remove purchase orders'],
            ['name' => 'Approve Purchase Orders','slug' => 'purchase-orders.approve','module' => 'purchase_orders', 'description' => 'Approve purchase orders for processing'],

            // ── Sales Orders ─────────────────────────
            ['name' => 'View Sales Orders',      'slug' => 'sales-orders.view',      'module' => 'sales_orders',    'description' => 'View outgoing sales orders'],
            ['name' => 'Create Sales Orders',    'slug' => 'sales-orders.create',    'module' => 'sales_orders',    'description' => 'Create new sales orders for customers'],
            ['name' => 'Edit Sales Orders',      'slug' => 'sales-orders.edit',      'module' => 'sales_orders',    'description' => 'Modify existing sales orders'],
            ['name' => 'Delete Sales Orders',    'slug' => 'sales-orders.delete',    'module' => 'sales_orders',    'description' => 'Cancel and remove sales orders'],
            ['name' => 'Approve Sales Orders',   'slug' => 'sales-orders.approve',   'module' => 'sales_orders',    'description' => 'Approve sales orders for fulfillment'],

            // ── Inventory ────────────────────────────
            ['name' => 'View Inventory',    'slug' => 'inventory.view',     'module' => 'inventory',       'description' => 'Browse inventory levels and stock'],
            ['name' => 'Adjust Inventory',  'slug' => 'inventory.adjust',   'module' => 'inventory',       'description' => 'Manually adjust stock quantities'],
            ['name' => 'Transfer Inventory','slug' => 'inventory.transfer', 'module' => 'inventory',       'description' => 'Transfer stock between warehouses'],

            // ── Warehouse ────────────────────────────
            ['name' => 'View Warehouse',    'slug' => 'warehouse.view',     'module' => 'warehouse',       'description' => 'View warehouse locations and bins'],
            ['name' => 'Manage Warehouse',  'slug' => 'warehouse.manage',   'module' => 'warehouse',       'description' => 'Configure warehouse layout and zones'],

            // ── Reports ──────────────────────────────
            ['name' => 'View Reports',      'slug' => 'reports.view',       'module' => 'reports',         'description' => 'Access standard reports'],
            ['name' => 'Generate Reports',  'slug' => 'reports.generate',   'module' => 'reports',         'description' => 'Run and schedule report generation'],
            ['name' => 'Export Reports',    'slug' => 'reports.export',     'module' => 'reports',         'description' => 'Export reports to PDF/Excel'],

            // ── Settings ─────────────────────────────
            ['name' => 'View Settings',     'slug' => 'settings.view',      'module' => 'settings',        'description' => 'View application settings'],
            ['name' => 'Edit Settings',     'slug' => 'settings.edit',      'module' => 'settings',        'description' => 'Modify application-wide configuration'],
        ];

        $permissions = [];
        foreach ($permissionsData as $data) {
            $permissions[$data['slug']] = Permission::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }

        // ─── 3. Assign Permissions to Roles ───────────────────────────

        // Super Admin → ALL permissions
        $roles['super-admin']->syncPermissions(
            collect($permissions)->pluck('id')->toArray()
        );

        // Admin → everything except delete roles, edit permissions, edit settings
        $adminExclude = ['roles.delete', 'permissions.edit', 'settings.edit'];
        $roles['admin']->syncPermissions(
            collect($permissions)
                ->reject(fn ($p) => in_array($p->slug, $adminExclude))
                ->pluck('id')
                ->toArray()
        );

        // Manager → operational access
        $managerSlugs = [
            'dashboard.view', 'dashboard.analytics',
            'products.view', 'products.edit', 'products.export',
            'categories.view', 'brands.view', 'suppliers.view',
            'customers.view', 'customers.edit',
            'purchase-orders.view', 'purchase-orders.create', 'purchase-orders.edit', 'purchase-orders.approve',
            'sales-orders.view', 'sales-orders.create', 'sales-orders.edit', 'sales-orders.approve',
            'inventory.view', 'inventory.adjust', 'inventory.transfer',
            'warehouse.view', 'warehouse.manage',
            'reports.view', 'reports.generate', 'reports.export',
        ];
        $roles['manager']->syncPermissions(
            collect($permissions)
                ->filter(fn ($p) => in_array($p->slug, $managerSlugs))
                ->pluck('id')
                ->toArray()
        );

        // Sales Agent → sales-focused access
        $salesSlugs = [
            'dashboard.view',
            'products.view', 'categories.view', 'brands.view',
            'customers.view', 'customers.create', 'customers.edit',
            'sales-orders.view', 'sales-orders.create', 'sales-orders.edit',
            'inventory.view',
            'reports.view',
        ];
        $roles['sales-agent']->syncPermissions(
            collect($permissions)
                ->filter(fn ($p) => in_array($p->slug, $salesSlugs))
                ->pluck('id')
                ->toArray()
        );

        // Warehouse Staff → warehouse & inventory focused
        $warehouseSlugs = [
            'dashboard.view',
            'products.view', 'categories.view',
            'purchase-orders.view',
            'sales-orders.view',
            'inventory.view', 'inventory.adjust', 'inventory.transfer',
            'warehouse.view', 'warehouse.manage',
            'reports.view',
        ];
        $roles['warehouse-staff']->syncPermissions(
            collect($permissions)
                ->filter(fn ($p) => in_array($p->slug, $warehouseSlugs))
                ->pluck('id')
                ->toArray()
        );

        // Viewer → read-only
        $viewerSlugs = [
            'dashboard.view',
            'products.view', 'categories.view', 'brands.view',
            'suppliers.view', 'customers.view',
            'purchase-orders.view', 'sales-orders.view',
            'inventory.view', 'warehouse.view',
            'reports.view',
        ];
        $roles['viewer']->syncPermissions(
            collect($permissions)
                ->filter(fn ($p) => in_array($p->slug, $viewerSlugs))
                ->pluck('id')
                ->toArray()
        );
        $supplierSlugs = [
            'dashboard.view',
            'products.view',
            'purchase-orders.view', 'purchase-orders.edit',
            'reports.view',
        ];
        $roles['supplier']->syncPermissions(
            collect($permissions)
                ->filter(fn ($p) => in_array($p->slug, $supplierSlugs))
                ->pluck('id')
                ->toArray()
        );


        $this->command->info('✅  Roles & Permissions seeded successfully.');
        $this->command->table(
            ['Role', 'Permissions Assigned'],
            collect($roles)->map(fn ($r) => [$r->name, $r->permissions()->count()])->toArray()
        );
    }
}
