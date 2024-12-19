<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Danh sách permissions
        $globalPermissions = [
            // Comment Management
            'comment.edit',
            'comment.view',
            'comment.approve',
            'comment.hide',
            'comment.unhide',

            // Coupon Management
            'coupon.create',
            'coupon.view',
            'coupon.edit',
            'coupon.delete',

            // Category Management
            'category.create',
            'category.view',
            'category.edit',
            'category.delete',

            // Post Management
            'post.create',
            'post.view',
            'post.edit',
            'post.delete',

            // Product Management
            'product.create',
            'product.view',
            'product.edit',
            'product.delete',
            'product.restore',

            // Attribute Management
            'attribute.create',
            'attribute.view',
            'attribute.edit',
            'attribute.delete',

            // Tag Management
            'tag.create',
            'tag.view',
            'tag.delete',

            // Ticket Management
            'ticket.create',
            'ticket.view',
            'ticket.chat',
            'ticket.update',

            // Banner Management
            'banner.create',
            'banner.view',
            'banner.edit',
            'banner.delete',

            // Order Management
            'order.view',
            'order.update',
            'order.detail',
            'order.updateshipping',

            // Wallet Management
            'wallet.view',
            'wallet.withdraw',
            'wallet.account',
            'wallet.userapprove',

            // Admin Account Management
            'superuser.create',
            'superuser.view',
            'superuser.edit',
            'superuser.delete',

            // Customer Management
            'customer.view',

            // Statistical View
            'stastical.view',
        ];

        // Tạo Permissions
        foreach ($globalPermissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Danh sách Roles và gán permissions tương ứng
        $roles = [
            'super_admin' => $globalPermissions, // Super Admin có tất cả các quyền
            'comment_manager' => [
                'comment.edit',
                'comment.view',
                'comment.approve',
                'comment.hide',
                'comment.unhide',
            ],
            'coupon_manager' => [
                'coupon.create',
                'coupon.view',
                'coupon.edit',
                'coupon.delete',
            ],
            'category_manager' => [
                'category.create',
                'category.view',
                'category.edit',
                'category.delete',
            ],
            'post_manager' => [
                'post.create',
                'post.view',
                'post.edit',
                'post.delete',
            ],
            'product_manager' => [
                'product.create',
                'product.view',
                'product.edit',
                'product.delete',
                'product.restore',
            ],
            'attribute_manager' => [
                'attribute.create',
                'attribute.view',
                'attribute.edit',
                'attribute.delete',
            ],
            'tag_manager' => [
                'tag.create',
                'tag.view',
                'tag.delete',
            ],
            'ticket_manager' => [
                'ticket.create',
                'ticket.view',
                'ticket.chat',
                'ticket.update',
            ],
            'banner_manager' => [
                'banner.create',
                'banner.view',
                'banner.edit',
                'banner.delete',
            ],
            'order_manager' => [
                'order.view',
                'order.update',
                'order.detail',
                'order.updateshipping',
            ],
            'wallet_manager' => [
                'wallet.view',
                'wallet.withdraw',
                'wallet.account',
                'wallet.userapprove',
            ],
            'customer_manager' => [
                'customer.view',
            ],
            'statistical_viewer' => [
                'stastical.view',
            ],
            'user' => [], // User không có quyền gì cả
        ];

        // Tạo Roles và gán permissions
        foreach ($roles as $roleName => $permissions) {
            $role = Role::create(['name' => $roleName]);
            $role->givePermissionTo($permissions);
        }


    }
}
