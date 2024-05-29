<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends \Spatie\Permission\Models\Permission
{
    use HasFactory;

    protected $fillable = ['display_group', 'display_name', 'name', 'guard_name'];

    public static function defaultAdminPermissions()
    {
        return array(
            array(
                'group' => 'Dashboard',
                'name' => 'Dashboard View',
                'role' => 'dashboard',
                'guard' => 'admin'
            ),
            array(
                'group' => 'Settings',
                'name' => 'Site Setting',
                'role' => 'site-setting',
                'guard' => 'admin'
            ),
            array(
                'group' => 'Administration',
                'name' => 'Role Management',
                'role' => 'role',
                'guard' => 'admin'
            ),
            array(
                'group' => 'Administration',
                'name' => 'User Management',
                'role' => 'user',
                'guard' => 'admin'
            ),
            array(
                'group' => 'Content Management',
                'name' => 'Slider Management',
                'role' => 'slider',
                'guard' => 'admin'
            ),
            array(
                'group' => 'Content Management',
                'name' => 'Pages Management',
                'role' => 'pages',
                'guard' => 'admin'
            ),
            array(
                'group' => 'Content Management',
                'name' => 'Gallery Management',
                'role' => 'gallery',
                'guard' => 'admin'
            ),
            array(
                'group' => 'Content Management',
                'name' => 'Logo Management',
                'role' => 'logo',
                'guard' => 'admin'
            ),
            array(
                'group' => 'Master Management',
                'name' => 'Product Type Management',
                'role' => 'product_type',
                'guard' => 'admin'
            ),
            array(
                'group' => 'Master Management',
                'name' => 'Product Used In Management',
                'role' => 'product_use_in',
                'guard' => 'admin'
            ),
            array(
                'group' => 'Master Management',
                'name' => 'Product Used Type Management',
                'role' => 'product_use_type',
                'guard' => 'admin'
            ),
            array(
                'group' => 'Master Management',
                'name' => 'Product Usage Management',
                'role' => 'product_usage',
                'guard' => 'admin'
            ),
            array(
                'group' => 'Master Management',
                'name' => 'Home Category Management',
                'role' => 'home_category',
                'guard' => 'admin'
            ),
            array(
                'group' => 'Master Management',
                'name' => 'Technical Specifications Management',
                'role' => 'technical_specifications',
                'guard' => 'admin'
            ),
            array(
                'group' => 'Products & Enquiry Management',
                'name' => 'Product Management',
                'role' => 'product',
                'guard' => 'admin'
            ),
            array(
                'group' => 'Products & Enquiry Management',
                'name' => 'Enquiry Management',
                'role' => 'enquiry',
                'guard' => 'admin'
            )                        
        );
    }

    public function scopeCheckGuard($query, $guard)
    {
        return $query->where('guard_name', $guard);
    }
}
