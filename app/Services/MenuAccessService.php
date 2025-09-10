<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MenuAccessService
{
    /**
     * Get accessible menus for a user based on their role and department
     *
     * @param string $userId
     * @return array
     */
    public static function getAccessibleMenus($userId = null)
    {
        if (!$userId) {
            $userId = Auth::id();
        }

        if (!$userId) {
            return [];
        }

        // Get user's active roles and departments
        $userRoles = DB::table('user_roles')
            ->join('roles', 'user_roles.role_id', '=', 'roles.id')
            ->where('user_roles.user_id', $userId)
            ->where('user_roles.is_active', true)
            ->select('roles.name as role_name', 'roles.level as role_level', 'user_roles.department_id')
            ->get();

        if ($userRoles->isEmpty()) {
            return [];
        }

        $roleNames = $userRoles->pluck('role_name')->toArray();
        $departments = $userRoles->pluck('department_id')->filter()->toArray();
        $minRoleLevel = $userRoles->min('role_level');

        // Get accessible menus
        $menus = DB::table('menus')
            ->where('is_active', true)
            ->where(function ($query) use ($roleNames, $departments, $minRoleLevel) {
                $query->where(function ($q) use ($roleNames) {
                    $q->whereNull('required_roles')
                      ->orWhereJsonContains('required_roles', $roleNames);
                })
                ->where(function ($q) use ($departments) {
                    $q->whereNull('required_departments')
                      ->orWhereJsonContains('required_departments', $departments);
                })
                ->where('min_role_level', '>=', $minRoleLevel);
            })
            ->orderBy('sort_order')
            ->get();

        return $menus->toArray();
    }

    /**
     * Get accessible submenus for a specific menu
     *
     * @param int $menuId
     * @param string $userId
     * @return array
     */
    public static function getAccessibleSubmenus($menuId, $userId = null)
    {
        if (!$userId) {
            $userId = Auth::id();
        }

        if (!$userId) {
            return [];
        }

        // Get user's active roles and departments
        $userRoles = DB::table('user_roles')
            ->join('roles', 'user_roles.role_id', '=', 'roles.id')
            ->where('user_roles.user_id', $userId)
            ->where('user_roles.is_active', true)
            ->select('roles.name as role_name', 'roles.level as role_level', 'user_roles.department_id')
            ->get();

        if ($userRoles->isEmpty()) {
            return [];
        }

        $roleNames = $userRoles->pluck('role_name')->toArray();
        $departments = $userRoles->pluck('department_id')->filter()->toArray();
        $minRoleLevel = $userRoles->min('role_level');

        // Get accessible submenus for the specific menu
        $submenus = DB::table('sub_menus')
            ->where('menu_id', $menuId)
            ->where('is_active', true)
            ->where(function ($query) use ($roleNames, $departments, $minRoleLevel) {
                $query->where(function ($q) use ($roleNames) {
                    $q->whereNull('required_roles')
                      ->orWhereJsonContains('required_roles', $roleNames);
                })
                ->where(function ($q) use ($departments) {
                    $q->whereNull('required_departments')
                      ->orWhereJsonContains('required_departments', $departments);
                })
                ->where('min_role_level', '>=', $minRoleLevel);
            })
            ->orderBy('sort_order')
            ->get();

        return $submenus->toArray();
    }

    /**
     * Check if user has permission for a specific action
     *
     * @param string $permission
     * @param string $userId
     * @return bool
     */
    public static function hasPermission($permission, $userId = null)
    {
        if (!$userId) {
            $userId = Auth::id();
        }

        if (!$userId) {
            return false;
        }

        // Get user's active roles
        $userRoles = DB::table('user_roles')
            ->join('roles', 'user_roles.role_id', '=', 'roles.id')
            ->where('user_roles.user_id', $userId)
            ->where('user_roles.is_active', true)
            ->select('roles.permissions')
            ->get();

        foreach ($userRoles as $role) {
            $permissions = json_decode($role->permissions, true);
            if (in_array($permission, $permissions)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get user's role information
     *
     * @param string $userId
     * @return array
     */
    public static function getUserRoles($userId = null)
    {
        if (!$userId) {
            $userId = Auth::id();
        }

        if (!$userId) {
            return [];
        }

        return DB::table('user_roles')
            ->join('roles', 'user_roles.role_id', '=', 'roles.id')
            ->join('departments', 'user_roles.department_id', '=', 'departments.id')
            ->where('user_roles.user_id', $userId)
            ->where('user_roles.is_active', true)
            ->select(
                'roles.name as role_name',
                'roles.display_name as role_display_name',
                'roles.level as role_level',
                'departments.department_name',
                'departments.department_code',
                'user_roles.assigned_at',
                'user_roles.expires_at'
            )
            ->get()
            ->toArray();
    }

    /**
     * Check if user can access a specific menu
     *
     * @param int $menuId
     * @param string $userId
     * @return bool
     */
    public static function canAccessMenu($menuId, $userId = null)
    {
        if (!$userId) {
            $userId = Auth::id();
        }

        if (!$userId) {
            return false;
        }

        $accessibleMenus = self::getAccessibleMenus($userId);
        $menuIds = array_column($accessibleMenus, 'id');
        
        return in_array($menuId, $menuIds);
    }

    /**
     * Get user type based on their highest role level
     *
     * @param string $userId
     * @return string
     */
    public static function getUserType($userId = null)
    {
        if (!$userId) {
            $userId = Auth::id();
        }

        if (!$userId) {
            return 'guest';
        }

        $userRoles = DB::table('user_roles')
            ->join('roles', 'user_roles.role_id', '=', 'roles.id')
            ->where('user_roles.user_id', $userId)
            ->where('user_roles.is_active', true)
            ->orderBy('roles.level')
            ->select('roles.name')
            ->first();

        return $userRoles ? $userRoles->name : 'guest';
    }
}
