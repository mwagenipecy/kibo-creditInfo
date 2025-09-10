<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get the Administration department ID
        $adminDept = DB::table('departments')->where('department_code', 'ADMIN')->first();
        if (!$adminDept) {
            $this->command->error('Administration department not found. Please run department migration first.');
            return;
        }

        // Get the roles
        $superAdminRole = DB::table('roles')->where('name', 'super_admin')->first();
        $adminRole = DB::table('roles')->where('name', 'admin')->first();

        if (!$superAdminRole || !$adminRole) {
            $this->command->error('Required roles not found. Please run role migration first.');
            return;
        }

        // Create admin users
        $adminUsers = [
            [
                'id' => Str::uuid(),
                'full_name' => 'Kibo Auto Super Admin',
                'email' => 'admin.kiboauto@kiboauto.co.tz',
                'password' => Hash::make('Admin@123456'),
                'user_type' => 'super_admin',
                'status' => 'active',
                'email_verified' => 'Yes',
                'phone_number' => '+255123456789',
                'role' => 'Super Admin',
                'department' => $adminDept->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'full_name' => 'Kibo Auto Admin 02',
                'email' => 'admin02.kiboauto@kiboauto.co.tz',
                'password' => Hash::make('Admin02@123456'),
                'user_type' => 'admin',
                'status' => 'active',
                'email_verified' => 'Yes',
                'phone_number' => '+255123456790',
                'role' => 'Admin',
                'department' => $adminDept->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert admin users and assign roles
        foreach ($adminUsers as $index => $user) {
            $userId = $user['id'];
            
            // Insert user
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']],
                $user
            );

            // Assign appropriate role
            $roleId = ($index === 0) ? $superAdminRole->id : $adminRole->id;
            
            DB::table('user_roles')->updateOrInsert(
                ['user_id' => $userId, 'role_id' => $roleId, 'department_id' => $adminDept->id],
                [
                    'assigned_by' => 'system',
                    'assigned_at' => now(),
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $this->command->info('Admin users created successfully with proper role assignments!');
        $this->command->info('Super Admin - Email: admin.kiboauto@kiboauto.co.tz | Password: Admin@123456');
        $this->command->info('Admin - Email: admin02.kiboauto@kiboauto.co.tz | Password: Admin02@123456');




        // INSERT INTO users ( name, email, password, status, phone_number, department, created_at, updated_at ) VALUES ( 'Kibo Auto Super Admin', 'admin.kiboauto@kiboauto.co.tz', '$2y$10$DE7Kr6zpKsixq949hXFymOkjp1tmeT1OTOqEhTNrg9IdpMIEjcVFm', 'ACTIVE', '+255123456789', 1, NOW(), NOW() ), ( 'Kibo Auto Admin 02', 'admin02.kiboauto@kiboauto.co.tz', '$2y$10$b6lXzdY1K1pinW18BmgLEO7mzFahvLZ8TGsMDJksvYWaAe0RtB1fG', 'ACTIVE', '+255123456790', 1, NOW(), NOW() );




    }
}
