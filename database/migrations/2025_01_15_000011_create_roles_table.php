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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('display_name');
            $table->text('description')->nullable();
            $table->string('department_code')->nullable(); // Link to department
            $table->json('permissions')->nullable(); // Store permissions as JSON
            $table->boolean('is_active')->default(true);
            $table->integer('level')->default(1); // Role hierarchy level (1=highest)
            $table->timestamps();
        });

        // Insert default roles for 6 user types
        DB::table('roles')->insert([
            // Super Admin - Full access to everything
            [
                'name' => 'super_admin',
                'display_name' => 'Super Administrator',
                'description' => 'Full system access with all permissions',
                'department_code' => 'ADMIN',
                'permissions' => json_encode([
                    'dashboard.view',
                    'users.manage', 'users.view', 'users.create', 'users.edit', 'users.delete',
                    'roles.manage', 'roles.view', 'roles.create', 'roles.edit', 'roles.delete',
                    'departments.manage', 'departments.view', 'departments.create', 'departments.edit', 'departments.delete',
                    'settings.manage', 'settings.general', 'settings.system', 'settings.email',
                    'reports.view', 'reports.financial', 'reports.users', 'reports.loans',
                    'loans.manage', 'loans.view', 'loans.create', 'loans.approve', 'loans.edit', 'loans.delete',
                    'clients.manage', 'clients.view', 'clients.create', 'clients.edit', 'clients.delete',
                    'payments.manage', 'payments.view', 'payments.create', 'payments.edit', 'payments.delete',
                    'accounting.manage', 'accounting.chart', 'accounting.journal',
                    'hr.manage', 'hr.employees', 'hr.payroll',
                    'procurement.manage', 'procurement.orders', 'procurement.suppliers'
                ]),
                'is_active' => true,
                'level' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Admin - High level access but limited to their department
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Administrative access with department-specific permissions',
                'department_code' => 'ADMIN',
                'permissions' => json_encode([
                    'dashboard.view',
                    'users.manage', 'users.view', 'users.create', 'users.edit',
                    'roles.view',
                    'departments.view',
                    'settings.general',
                    'reports.view', 'reports.financial', 'reports.users', 'reports.loans',
                    'loans.manage', 'loans.view', 'loans.create', 'loans.approve', 'loans.edit',
                    'clients.manage', 'clients.view', 'clients.create', 'clients.edit',
                    'payments.manage', 'payments.view', 'payments.create', 'payments.edit',
                    'accounting.manage', 'accounting.chart', 'accounting.journal',
                    'hr.manage', 'hr.employees', 'hr.payroll',
                    'procurement.manage', 'procurement.orders', 'procurement.suppliers'
                ]),
                'is_active' => true,
                'level' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Manager - Department-specific management access
            [
                'name' => 'manager',
                'display_name' => 'Manager',
                'description' => 'Department management with limited administrative access',
                'department_code' => null, // Can be assigned to any department
                'permissions' => json_encode([
                    'dashboard.view',
                    'users.view', 'users.create', 'users.edit',
                    'reports.view', 'reports.financial', 'reports.users', 'reports.loans',
                    'loans.view', 'loans.create', 'loans.approve', 'loans.edit',
                    'clients.manage', 'clients.view', 'clients.create', 'clients.edit',
                    'payments.view', 'payments.create', 'payments.edit',
                    'accounting.chart', 'accounting.journal',
                    'hr.employees', 'hr.payroll',
                    'procurement.orders', 'procurement.suppliers'
                ]),
                'is_active' => true,
                'level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Employee - Basic operational access
            [
                'name' => 'employee',
                'display_name' => 'Employee',
                'description' => 'Basic operational access for daily tasks',
                'department_code' => null, // Can be assigned to any department
                'permissions' => json_encode([
                    'dashboard.view',
                    'loans.view', 'loans.create',
                    'clients.view', 'clients.create',
                    'payments.view', 'payments.create',
                    'accounting.chart',
                    'hr.employees'
                ]),
                'is_active' => true,
                'level' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Customer - Limited access to their own data
            [
                'name' => 'customer',
                'display_name' => 'Customer',
                'description' => 'Customer access to their own information and services',
                'department_code' => null,
                'permissions' => json_encode([
                    'dashboard.view',
                    'loans.view', 'loans.create',
                    'payments.view',
                    'profile.edit'
                ]),
                'is_active' => true,
                'level' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Lender - Financial institution access
            [
                'name' => 'lender',
                'display_name' => 'Lender',
                'description' => 'Financial institution providing vehicle financing',
                'department_code' => 'LENDER',
                'permissions' => json_encode([
                    'dashboard.view',
                    'loans.view', 'loans.approve', 'loans.reject',
                    'clients.view',
                    'payments.view',
                    'reports.financial',
                    'profile.edit'
                ]),
                'is_active' => true,
                'level' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Dealer - Car dealership access
            [
                'name' => 'dealer',
                'display_name' => 'Car Dealer',
                'description' => 'Vehicle dealership managing inventory and sales',
                'department_code' => 'CAR_DEALER',
                'permissions' => json_encode([
                    'dashboard.view',
                    'vehicles.manage', 'vehicles.view', 'vehicles.create', 'vehicles.edit', 'vehicles.delete',
                    'loans.view',
                    'clients.view', 'clients.create',
                    'reports.vehicles',
                    'profile.edit'
                ]),
                'is_active' => true,
                'level' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Shop Owner - Spare parts management access
            [
                'name' => 'shop_owner',
                'display_name' => 'Shop Owner',
                'description' => 'Spare parts shop owner managing inventory and sales',
                'department_code' => 'SHOP_OWNER',
                'permissions' => json_encode([
                    'dashboard.view',
                    'spare_parts.manage', 'spare_parts.view', 'spare_parts.create', 'spare_parts.edit', 'spare_parts.delete',
                    'inventory.manage', 'inventory.view', 'inventory.create', 'inventory.edit',
                    'orders.manage', 'orders.view', 'orders.create', 'orders.edit',
                    'reports.sales',
                    'profile.edit'
                ]),
                'is_active' => true,
                'level' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Clearance & Forwarding - Import/export services access
            [
                'name' => 'clearance_forwarding',
                'display_name' => 'Clearance & Forwarding',
                'description' => 'Company providing vehicle import/export clearance services',
                'department_code' => 'CLEARANCE_FORWARDING',
                'permissions' => json_encode([
                    'dashboard.view',
                    'clearance.manage', 'clearance.view', 'clearance.create', 'clearance.edit',
                    'quotations.manage', 'quotations.view', 'quotations.create', 'quotations.edit',
                    'vehicles.view',
                    'reports.clearance',
                    'profile.edit'
                ]),
                'is_active' => true,
                'level' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Guest - Very limited access
            [
                'name' => 'guest',
                'display_name' => 'Guest',
                'description' => 'Limited access for guest users',
                'department_code' => null,
                'permissions' => json_encode([
                    'dashboard.view',
                    'loans.create' // Can only create loan applications
                ]),
                'is_active' => true,
                'level' => 6,
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
        Schema::dropIfExists('roles');
    }
};
