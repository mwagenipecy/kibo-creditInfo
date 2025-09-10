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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('menu_name');
            $table->string('menu_icon')->nullable();
            $table->string('menu_url')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_parent')->default(false);
            $table->string('permission')->nullable();
            $table->json('required_roles')->nullable(); // Required roles to see this menu
            $table->json('required_departments')->nullable(); // Required departments to see this menu
            $table->integer('min_role_level')->default(1); // Minimum role level required
            $table->timestamps();
        });

        // Insert default menus data for 6 departments
        DB::table('menus')->insert([
            // Dashboard - Available to all departments
            [
                'menu_name' => 'Dashboard',
                'menu_icon' => 'fas fa-tachometer-alt',
                'menu_url' => '/dashboard',
                'sort_order' => 1,
                'is_active' => true,
                'is_parent' => false,
                'permission' => 'dashboard.view',
                'required_roles' => json_encode(['super_admin', 'admin', 'manager', 'employee', 'customer', 'guest']),
                'required_departments' => null,
                'min_role_level' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Administration Department Menus
            [
                'menu_name' => 'User Management',
                'menu_icon' => 'fas fa-users',
                'menu_url' => null,
                'sort_order' => 2,
                'is_active' => true,
                'is_parent' => true,
                'permission' => 'users.manage',
                'required_roles' => json_encode(['super_admin', 'admin']),
                'required_departments' => json_encode([1]), // Administration
                'min_role_level' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_name' => 'Settings',
                'menu_icon' => 'fas fa-cog',
                'menu_url' => null,
                'sort_order' => 3,
                'is_active' => true,
                'is_parent' => true,
                'permission' => 'settings.manage',
                'required_roles' => json_encode(['super_admin', 'admin']),
                'required_departments' => json_encode([1]), // Administration
                'min_role_level' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_name' => 'Reports',
                'menu_icon' => 'fas fa-chart-bar',
                'menu_url' => null,
                'sort_order' => 4,
                'is_active' => true,
                'is_parent' => true,
                'permission' => 'reports.view',
                'required_roles' => json_encode(['super_admin', 'admin', 'manager']),
                'required_departments' => json_encode([1]), // Administration
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Lender Department Menus
            [
                'menu_name' => 'Loan Applications',
                'menu_icon' => 'fas fa-file-alt',
                'menu_url' => null,
                'sort_order' => 5,
                'is_active' => true,
                'is_parent' => true,
                'permission' => 'loans.manage',
                'required_roles' => json_encode(['lender', 'admin', 'manager']),
                'required_departments' => json_encode([2]), // Lender
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_name' => 'Financial Reports',
                'menu_icon' => 'fas fa-chart-line',
                'menu_url' => null,
                'sort_order' => 6,
                'is_active' => true,
                'is_parent' => true,
                'permission' => 'reports.financial',
                'required_roles' => json_encode(['lender', 'admin', 'manager']),
                'required_departments' => json_encode([2]), // Lender
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Car Dealer Department Menus
            [
                'menu_name' => 'Vehicle Inventory',
                'menu_icon' => 'fas fa-car',
                'menu_url' => null,
                'sort_order' => 7,
                'is_active' => true,
                'is_parent' => true,
                'permission' => 'vehicles.manage',
                'required_roles' => json_encode(['dealer', 'admin', 'manager']),
                'required_departments' => json_encode([3]), // Car Dealer
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_name' => 'Sales Management',
                'menu_icon' => 'fas fa-handshake',
                'menu_url' => null,
                'sort_order' => 8,
                'is_active' => true,
                'is_parent' => true,
                'permission' => 'sales.manage',
                'required_roles' => json_encode(['dealer', 'admin', 'manager']),
                'required_departments' => json_encode([3]), // Car Dealer
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Client/Borrower Department Menus
            [
                'menu_name' => 'My Applications',
                'menu_icon' => 'fas fa-file-invoice',
                'menu_url' => null,
                'sort_order' => 9,
                'is_active' => true,
                'is_parent' => true,
                'permission' => 'applications.view_own',
                'required_roles' => json_encode(['customer']),
                'required_departments' => json_encode([4]), // Client/Borrower
                'min_role_level' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_name' => 'My Profile',
                'menu_icon' => 'fas fa-user',
                'menu_url' => null,
                'sort_order' => 10,
                'is_active' => true,
                'is_parent' => true,
                'permission' => 'profile.manage',
                'required_roles' => json_encode(['customer']),
                'required_departments' => json_encode([4]), // Client/Borrower
                'min_role_level' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Shop Owner Department Menus
            [
                'menu_name' => 'Spare Parts Inventory',
                'menu_icon' => 'fas fa-cogs',
                'menu_url' => null,
                'sort_order' => 11,
                'is_active' => true,
                'is_parent' => true,
                'permission' => 'spare_parts.manage',
                'required_roles' => json_encode(['shop_owner', 'admin', 'manager']),
                'required_departments' => json_encode([5]), // Shop Owner
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_name' => 'Orders Management',
                'menu_icon' => 'fas fa-shopping-cart',
                'menu_url' => null,
                'sort_order' => 12,
                'is_active' => true,
                'is_parent' => true,
                'permission' => 'orders.manage',
                'required_roles' => json_encode(['shop_owner', 'admin', 'manager']),
                'required_departments' => json_encode([5]), // Shop Owner
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Clearance & Forwarding Department Menus
            [
                'menu_name' => 'Clearance Services',
                'menu_icon' => 'fas fa-shipping-fast',
                'menu_url' => null,
                'sort_order' => 13,
                'is_active' => true,
                'is_parent' => true,
                'permission' => 'clearance.manage',
                'required_roles' => json_encode(['clearance_forwarding', 'admin', 'manager']),
                'required_departments' => json_encode([6]), // Clearance & Forwarding
                'min_role_level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'menu_name' => 'Quotations',
                'menu_icon' => 'fas fa-file-invoice-dollar',
                'menu_url' => null,
                'sort_order' => 14,
                'is_active' => true,
                'is_parent' => true,
                'permission' => 'quotations.manage',
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
        Schema::dropIfExists('menus');
    }
};
