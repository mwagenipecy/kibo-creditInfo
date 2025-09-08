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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('display_name');
            $table->text('description')->nullable();
            $table->string('category')->nullable(); // Group permissions by category
            $table->string('department_code')->nullable(); // Department-specific permissions
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Insert comprehensive permissions
        DB::table('permissions')->insert([
            // Dashboard permissions
            ['name' => 'dashboard.view', 'display_name' => 'View Dashboard', 'description' => 'Access to main dashboard', 'category' => 'Dashboard', 'department_code' => null, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // User Management permissions
            ['name' => 'users.manage', 'display_name' => 'Manage Users', 'description' => 'Full user management access', 'category' => 'User Management', 'department_code' => 'ADMIN', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'users.view', 'display_name' => 'View Users', 'description' => 'View user information', 'category' => 'User Management', 'department_code' => null, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'users.create', 'display_name' => 'Create Users', 'description' => 'Create new users', 'category' => 'User Management', 'department_code' => null, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'users.edit', 'display_name' => 'Edit Users', 'description' => 'Edit user information', 'category' => 'User Management', 'department_code' => null, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'users.delete', 'display_name' => 'Delete Users', 'description' => 'Delete users', 'category' => 'User Management', 'department_code' => 'ADMIN', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Role Management permissions
            ['name' => 'roles.manage', 'display_name' => 'Manage Roles', 'description' => 'Full role management access', 'category' => 'Role Management', 'department_code' => 'ADMIN', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'roles.view', 'display_name' => 'View Roles', 'description' => 'View role information', 'category' => 'Role Management', 'department_code' => null, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'roles.create', 'display_name' => 'Create Roles', 'description' => 'Create new roles', 'category' => 'Role Management', 'department_code' => 'ADMIN', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'roles.edit', 'display_name' => 'Edit Roles', 'description' => 'Edit role information', 'category' => 'Role Management', 'department_code' => 'ADMIN', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'roles.delete', 'display_name' => 'Delete Roles', 'description' => 'Delete roles', 'category' => 'Role Management', 'department_code' => 'ADMIN', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Department Management permissions
            ['name' => 'departments.manage', 'display_name' => 'Manage Departments', 'description' => 'Full department management access', 'category' => 'Department Management', 'department_code' => 'ADMIN', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'departments.view', 'display_name' => 'View Departments', 'description' => 'View department information', 'category' => 'Department Management', 'department_code' => null, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'departments.create', 'display_name' => 'Create Departments', 'description' => 'Create new departments', 'category' => 'Department Management', 'department_code' => 'ADMIN', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'departments.edit', 'display_name' => 'Edit Departments', 'description' => 'Edit department information', 'category' => 'Department Management', 'department_code' => 'ADMIN', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'departments.delete', 'display_name' => 'Delete Departments', 'description' => 'Delete departments', 'category' => 'Department Management', 'department_code' => 'ADMIN', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Settings permissions
            ['name' => 'settings.manage', 'display_name' => 'Manage Settings', 'description' => 'Full settings management access', 'category' => 'Settings', 'department_code' => 'ADMIN', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'settings.general', 'display_name' => 'General Settings', 'description' => 'Access to general settings', 'category' => 'Settings', 'department_code' => null, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'settings.system', 'display_name' => 'System Settings', 'description' => 'Access to system settings', 'category' => 'Settings', 'department_code' => 'ADMIN', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'settings.email', 'display_name' => 'Email Settings', 'description' => 'Access to email settings', 'category' => 'Settings', 'department_code' => 'ADMIN', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Reports permissions
            ['name' => 'reports.view', 'display_name' => 'View Reports', 'description' => 'Access to reports', 'category' => 'Reports', 'department_code' => null, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'reports.financial', 'display_name' => 'Financial Reports', 'description' => 'Access to financial reports', 'category' => 'Reports', 'department_code' => 'FINANCE', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'reports.users', 'display_name' => 'User Reports', 'description' => 'Access to user reports', 'category' => 'Reports', 'department_code' => 'HR', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'reports.loans', 'display_name' => 'Loan Reports', 'description' => 'Access to loan reports', 'category' => 'Reports', 'department_code' => 'FINANCE', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Loan Management permissions
            ['name' => 'loans.manage', 'display_name' => 'Manage Loans', 'description' => 'Full loan management access', 'category' => 'Loan Management', 'department_code' => 'FINANCE', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'loans.view', 'display_name' => 'View Loans', 'description' => 'View loan information', 'category' => 'Loan Management', 'department_code' => null, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'loans.create', 'display_name' => 'Create Loans', 'description' => 'Create new loan applications', 'category' => 'Loan Management', 'department_code' => null, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'loans.approve', 'display_name' => 'Approve Loans', 'description' => 'Approve loan applications', 'category' => 'Loan Management', 'department_code' => 'FINANCE', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'loans.edit', 'display_name' => 'Edit Loans', 'description' => 'Edit loan information', 'category' => 'Loan Management', 'department_code' => 'FINANCE', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'loans.delete', 'display_name' => 'Delete Loans', 'description' => 'Delete loans', 'category' => 'Loan Management', 'department_code' => 'FINANCE', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Client Management permissions
            ['name' => 'clients.manage', 'display_name' => 'Manage Clients', 'description' => 'Full client management access', 'category' => 'Client Management', 'department_code' => 'SALES', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'clients.view', 'display_name' => 'View Clients', 'description' => 'View client information', 'category' => 'Client Management', 'department_code' => null, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'clients.create', 'display_name' => 'Create Clients', 'description' => 'Create new clients', 'category' => 'Client Management', 'department_code' => null, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'clients.edit', 'display_name' => 'Edit Clients', 'description' => 'Edit client information', 'category' => 'Client Management', 'department_code' => 'SALES', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'clients.delete', 'display_name' => 'Delete Clients', 'description' => 'Delete clients', 'category' => 'Client Management', 'department_code' => 'SALES', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Payment Management permissions
            ['name' => 'payments.manage', 'display_name' => 'Manage Payments', 'description' => 'Full payment management access', 'category' => 'Payment Management', 'department_code' => 'FINANCE', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'payments.view', 'display_name' => 'View Payments', 'description' => 'View payment information', 'category' => 'Payment Management', 'department_code' => null, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'payments.create', 'display_name' => 'Create Payments', 'description' => 'Process new payments', 'category' => 'Payment Management', 'department_code' => 'FINANCE', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'payments.edit', 'display_name' => 'Edit Payments', 'description' => 'Edit payment information', 'category' => 'Payment Management', 'department_code' => 'FINANCE', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'payments.delete', 'display_name' => 'Delete Payments', 'description' => 'Delete payments', 'category' => 'Payment Management', 'department_code' => 'FINANCE', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Accounting permissions
            ['name' => 'accounting.manage', 'display_name' => 'Manage Accounting', 'description' => 'Full accounting management access', 'category' => 'Accounting', 'department_code' => 'FINANCE', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'accounting.chart', 'display_name' => 'Chart of Accounts', 'description' => 'Access to chart of accounts', 'category' => 'Accounting', 'department_code' => 'FINANCE', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'accounting.journal', 'display_name' => 'Journal Entries', 'description' => 'Access to journal entries', 'category' => 'Accounting', 'department_code' => 'FINANCE', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // HR permissions
            ['name' => 'hr.manage', 'display_name' => 'Manage HR', 'description' => 'Full HR management access', 'category' => 'Human Resources', 'department_code' => 'HR', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'hr.employees', 'display_name' => 'Employee Management', 'description' => 'Access to employee management', 'category' => 'Human Resources', 'department_code' => 'HR', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'hr.payroll', 'display_name' => 'Payroll Management', 'description' => 'Access to payroll management', 'category' => 'Human Resources', 'department_code' => 'HR', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Procurement permissions
            ['name' => 'procurement.manage', 'display_name' => 'Manage Procurement', 'description' => 'Full procurement management access', 'category' => 'Procurement', 'department_code' => 'OPERATIONS', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'procurement.orders', 'display_name' => 'Purchase Orders', 'description' => 'Access to purchase orders', 'category' => 'Procurement', 'department_code' => 'OPERATIONS', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'procurement.suppliers', 'display_name' => 'Supplier Management', 'description' => 'Access to supplier management', 'category' => 'Procurement', 'department_code' => 'OPERATIONS', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            
            // Profile permissions
            ['name' => 'profile.edit', 'display_name' => 'Edit Profile', 'description' => 'Edit own profile information', 'category' => 'Profile', 'department_code' => null, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
};
