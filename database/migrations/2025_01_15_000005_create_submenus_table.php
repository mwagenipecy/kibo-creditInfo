<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade');
            $table->string('submenu_name');
            $table->string('submenu_icon')->nullable();
            $table->string('submenu_url');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('permission')->nullable();
            $table->json('required_roles')->nullable(); // Required roles to see this submenu
            $table->json('required_departments')->nullable(); // Required departments to see this submenu
            $table->integer('min_role_level')->default(1); // Minimum role level required
            $table->timestamps();
        });

        // Insert default submenus data for 6 departments
        DB::table('sub_menus')->insert([
            // Administration Department Submenus
            [
                'menu_id' => 2, // User Management
                'submenu_name' => 'All Users',
                'submenu_icon' => 'fas fa-users',
                'submenu_url' => '/users',
                'sort_order' => 1,
                'is_active' => true,
                'permission' => 'users.view',
                'required_roles' => json_encode(['super_admin', 'admin']),
                'required_departments' => json_encode([1]), // Administration
                'min_role_level' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 2, // User Management
                'submenu_name' => 'Add User',
                'submenu_icon' => 'fas fa-user-plus',
                'submenu_url' => '/users/create',
                'sort_order' => 2,
                'is_active' => true,
                'permission' => 'users.create',
                'required_roles' => json_encode(['super_admin', 'admin']),
                'required_departments' => json_encode([1]), // Administration
                'min_role_level' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 2, // User Management
                'submenu_name' => 'Roles & Permissions',
                'submenu_icon' => 'fas fa-user-shield',
                'submenu_url' => '/roles',
                'sort_order' => 3,
                'is_active' => true,
                'permission' => 'roles.manage',
                'required_roles' => json_encode(['super_admin']),
                'required_departments' => json_encode([1]), // Administration
                'min_role_level' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 2, // User Management
                'submenu_name' => 'Departments',
                'submenu_icon' => 'fas fa-building',
                'submenu_url' => '/departments',
                'sort_order' => 4,
                'is_active' => true,
                'permission' => 'departments.manage',
                'required_roles' => json_encode(['super_admin']),
                'required_departments' => json_encode([1]), // Administration
                'min_role_level' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 3, // Settings
                'submenu_name' => 'General Settings',
                'submenu_icon' => 'fas fa-cog',
                'submenu_url' => '/settings/general',
                'sort_order' => 1,
                'is_active' => true,
                'permission' => 'settings.general',
                'required_roles' => json_encode(['super_admin', 'admin']),
                'required_departments' => json_encode([1]), // Administration
                'min_role_level' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 3, // Settings
                'submenu_name' => 'System Settings',
                'submenu_icon' => 'fas fa-server',
                'submenu_url' => '/settings/system',
                'sort_order' => 2,
                'is_active' => true,
                'permission' => 'settings.system',
                'required_roles' => json_encode(['super_admin', 'admin']),
                'required_departments' => json_encode([1]), // Administration
                'min_role_level' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 3, // Settings
                'submenu_name' => 'Email Settings',
                'submenu_icon' => 'fas fa-envelope',
                'submenu_url' => '/settings/email',
                'sort_order' => 3,
                'is_active' => true,
                'permission' => 'settings.email',
                'required_roles' => json_encode(['super_admin', 'admin']),
                'required_departments' => json_encode([1]), // Administration
                'min_role_level' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 4, // Reports
                'submenu_name' => 'System Reports',
                'submenu_icon' => 'fas fa-chart-bar',
                'submenu_url' => '/reports/system',
                'sort_order' => 1,
                'is_active' => true,
                'permission' => 'reports.system',
                'required_roles' => json_encode(['super_admin', 'admin', 'manager']),
                'required_departments' => json_encode([1]), // Administration
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 4, // Reports
                'submenu_name' => 'User Activity',
                'submenu_icon' => 'fas fa-user-chart',
                'submenu_url' => '/reports/user-activity',
                'sort_order' => 2,
                'is_active' => true,
                'permission' => 'reports.user_activity',
                'required_roles' => json_encode(['super_admin', 'admin', 'manager']),
                'required_departments' => json_encode([1]), // Administration
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Lender Department Submenus
            [
                'menu_id' => 5, // Loan Applications
                'submenu_name' => 'All Applications',
                'submenu_icon' => 'fas fa-list',
                'submenu_url' => '/loans/applications',
                'sort_order' => 1,
                'is_active' => true,
                'permission' => 'loans.view',
                'required_roles' => json_encode(['lender', 'admin', 'manager']),
                'required_departments' => json_encode([2]), // Lender
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 5, // Loan Applications
                'submenu_name' => 'Pending Review',
                'submenu_icon' => 'fas fa-clock',
                'submenu_url' => '/loans/pending',
                'sort_order' => 2,
                'is_active' => true,
                'permission' => 'loans.review',
                'required_roles' => json_encode(['lender', 'admin', 'manager']),
                'required_departments' => json_encode([2]), // Lender
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 5, // Loan Applications
                'submenu_name' => 'Approved Loans',
                'submenu_icon' => 'fas fa-check-circle',
                'submenu_url' => '/loans/approved',
                'sort_order' => 3,
                'is_active' => true,
                'permission' => 'loans.approved',
                'required_roles' => json_encode(['lender', 'admin', 'manager']),
                'required_departments' => json_encode([2]), // Lender
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 6, // Financial Reports
                'submenu_name' => 'Loan Portfolio',
                'submenu_icon' => 'fas fa-chart-pie',
                'submenu_url' => '/reports/loan-portfolio',
                'sort_order' => 1,
                'is_active' => true,
                'permission' => 'reports.loan_portfolio',
                'required_roles' => json_encode(['lender', 'admin', 'manager']),
                'required_departments' => json_encode([2]), // Lender
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 6, // Financial Reports
                'submenu_name' => 'Payment History',
                'submenu_icon' => 'fas fa-credit-card',
                'submenu_url' => '/reports/payments',
                'sort_order' => 2,
                'is_active' => true,
                'permission' => 'reports.payments',
                'required_roles' => json_encode(['lender', 'admin', 'manager']),
                'required_departments' => json_encode([2]), // Lender
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Car Dealer Department Submenus
            [
                'menu_id' => 7, // Vehicle Inventory
                'submenu_name' => 'All Vehicles',
                'submenu_icon' => 'fas fa-car',
                'submenu_url' => '/vehicles',
                'sort_order' => 1,
                'is_active' => true,
                'permission' => 'vehicles.view',
                'required_roles' => json_encode(['dealer', 'admin', 'manager']),
                'required_departments' => json_encode([3]), // Car Dealer
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 7, // Vehicle Inventory
                'submenu_name' => 'Add Vehicle',
                'submenu_icon' => 'fas fa-plus',
                'submenu_url' => '/vehicles/create',
                'sort_order' => 2,
                'is_active' => true,
                'permission' => 'vehicles.create',
                'required_roles' => json_encode(['dealer', 'admin', 'manager']),
                'required_departments' => json_encode([3]), // Car Dealer
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 7, // Vehicle Inventory
                'submenu_name' => 'Vehicle Categories',
                'submenu_icon' => 'fas fa-tags',
                'submenu_url' => '/vehicles/categories',
                'sort_order' => 3,
                'is_active' => true,
                'permission' => 'vehicles.categories',
                'required_roles' => json_encode(['dealer', 'admin', 'manager']),
                'required_departments' => json_encode([3]), // Car Dealer
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 8, // Sales Management
                'submenu_name' => 'Sales Dashboard',
                'submenu_icon' => 'fas fa-chart-line',
                'submenu_url' => '/sales/dashboard',
                'sort_order' => 1,
                'is_active' => true,
                'permission' => 'sales.dashboard',
                'required_roles' => json_encode(['dealer', 'admin', 'manager']),
                'required_departments' => json_encode([3]), // Car Dealer
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 8, // Sales Management
                'submenu_name' => 'Customer Inquiries',
                'submenu_icon' => 'fas fa-question-circle',
                'submenu_url' => '/sales/inquiries',
                'sort_order' => 2,
                'is_active' => true,
                'permission' => 'sales.inquiries',
                'required_roles' => json_encode(['dealer', 'admin', 'manager']),
                'required_departments' => json_encode([3]), // Car Dealer
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Client/Borrower Department Submenus
            [
                'menu_id' => 9, // My Applications
                'submenu_name' => 'New Application',
                'submenu_icon' => 'fas fa-plus-circle',
                'submenu_url' => '/applications/create',
                'sort_order' => 1,
                'is_active' => true,
                'permission' => 'applications.create',
                'required_roles' => json_encode(['customer']),
                'required_departments' => json_encode([4]), // Client/Borrower
                'min_role_level' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 9, // My Applications
                'submenu_name' => 'Application Status',
                'submenu_icon' => 'fas fa-info-circle',
                'submenu_url' => '/applications/status',
                'sort_order' => 2,
                'is_active' => true,
                'permission' => 'applications.status',
                'required_roles' => json_encode(['customer']),
                'required_departments' => json_encode([4]), // Client/Borrower
                'min_role_level' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 9, // My Applications
                'submenu_name' => 'Payment Schedule',
                'submenu_icon' => 'fas fa-calendar',
                'submenu_url' => '/applications/payments',
                'sort_order' => 3,
                'is_active' => true,
                'permission' => 'applications.payments',
                'required_roles' => json_encode(['customer']),
                'required_departments' => json_encode([4]), // Client/Borrower
                'min_role_level' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 10, // My Profile
                'submenu_name' => 'Personal Information',
                'submenu_icon' => 'fas fa-user',
                'submenu_url' => '/profile/personal',
                'sort_order' => 1,
                'is_active' => true,
                'permission' => 'profile.personal',
                'required_roles' => json_encode(['customer']),
                'required_departments' => json_encode([4]), // Client/Borrower
                'min_role_level' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 10, // My Profile
                'submenu_name' => 'Documents',
                'submenu_icon' => 'fas fa-file-upload',
                'submenu_url' => '/profile/documents',
                'sort_order' => 2,
                'is_active' => true,
                'permission' => 'profile.documents',
                'required_roles' => json_encode(['customer']),
                'required_departments' => json_encode([4]), // Client/Borrower
                'min_role_level' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Shop Owner Department Submenus
            [
                'menu_id' => 11, // Spare Parts Inventory
                'submenu_name' => 'All Parts',
                'submenu_icon' => 'fas fa-cogs',
                'submenu_url' => '/spare-parts',
                'sort_order' => 1,
                'is_active' => true,
                'permission' => 'spare_parts.view',
                'required_roles' => json_encode(['shop_owner', 'admin', 'manager']),
                'required_departments' => json_encode([5]), // Shop Owner
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 11, // Spare Parts Inventory
                'submenu_name' => 'Add Part',
                'submenu_icon' => 'fas fa-plus',
                'submenu_url' => '/spare-parts/create',
                'sort_order' => 2,
                'is_active' => true,
                'permission' => 'spare_parts.create',
                'required_roles' => json_encode(['shop_owner', 'admin', 'manager']),
                'required_departments' => json_encode([5]), // Shop Owner
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 11, // Spare Parts Inventory
                'submenu_name' => 'Categories',
                'submenu_icon' => 'fas fa-tags',
                'submenu_url' => '/spare-parts/categories',
                'sort_order' => 3,
                'is_active' => true,
                'permission' => 'spare_parts.categories',
                'required_roles' => json_encode(['shop_owner', 'admin', 'manager']),
                'required_departments' => json_encode([5]), // Shop Owner
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 12, // Orders Management
                'submenu_name' => 'All Orders',
                'submenu_icon' => 'fas fa-shopping-cart',
                'submenu_url' => '/orders',
                'sort_order' => 1,
                'is_active' => true,
                'permission' => 'orders.view',
                'required_roles' => json_encode(['shop_owner', 'admin', 'manager']),
                'required_departments' => json_encode([5]), // Shop Owner
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 12, // Orders Management
                'submenu_name' => 'Pending Orders',
                'submenu_icon' => 'fas fa-clock',
                'submenu_url' => '/orders/pending',
                'sort_order' => 2,
                'is_active' => true,
                'permission' => 'orders.pending',
                'required_roles' => json_encode(['shop_owner', 'admin', 'manager']),
                'required_departments' => json_encode([5]), // Shop Owner
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Clearance & Forwarding Department Submenus
            [
                'menu_id' => 13, // Clearance Services
                'submenu_name' => 'All Services',
                'submenu_icon' => 'fas fa-shipping-fast',
                'submenu_url' => '/clearance/services',
                'sort_order' => 1,
                'is_active' => true,
                'permission' => 'clearance.view',
                'required_roles' => json_encode(['clearance_forwarding', 'admin', 'manager']),
                'required_departments' => json_encode([6]), // Clearance & Forwarding
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 13, // Clearance Services
                'submenu_name' => 'New Service',
                'submenu_icon' => 'fas fa-plus',
                'submenu_url' => '/clearance/services/create',
                'sort_order' => 2,
                'is_active' => true,
                'permission' => 'clearance.create',
                'required_roles' => json_encode(['clearance_forwarding', 'admin', 'manager']),
                'required_departments' => json_encode([6]), // Clearance & Forwarding
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 13, // Clearance Services
                'submenu_name' => 'Service Status',
                'submenu_icon' => 'fas fa-info-circle',
                'submenu_url' => '/clearance/status',
                'sort_order' => 3,
                'is_active' => true,
                'permission' => 'clearance.status',
                'required_roles' => json_encode(['clearance_forwarding', 'admin', 'manager']),
                'required_departments' => json_encode([6]), // Clearance & Forwarding
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 14, // Quotations
                'submenu_name' => 'All Quotations',
                'submenu_icon' => 'fas fa-file-invoice-dollar',
                'submenu_url' => '/quotations',
                'sort_order' => 1,
                'is_active' => true,
                'permission' => 'quotations.view',
                'required_roles' => json_encode(['clearance_forwarding', 'admin', 'manager']),
                'required_departments' => json_encode([6]), // Clearance & Forwarding
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_id' => 14, // Quotations
                'submenu_name' => 'Create Quotation',
                'submenu_icon' => 'fas fa-plus',
                'submenu_url' => '/quotations/create',
                'sort_order' => 2,
                'is_active' => true,
                'permission' => 'quotations.create',
                'required_roles' => json_encode(['clearance_forwarding', 'admin', 'manager']),
                'required_departments' => json_encode([6]), // Clearance & Forwarding
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_menus');
    }
};
