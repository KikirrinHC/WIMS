<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $superadmin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($superadmin_permissions->pluck('id'));
        $admin_permissions = $superadmin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_' && substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_';
        });
        $admin_permissions = $admin_permissions->filter(function ($permission) {
            return $permission->title != 'faq_management_access' && $permission->title != 'faq_category_create' && $permission->title != 'faq_category_edit' && $permission->title != 'faq_category_delete' && $permission->title != 'faq_question_create' && $permission->title != 'faq_question_edit' && $permission->title != 'faq_question_delete';
        });
        Role::findOrFail(2)->permissions()->sync($admin_permissions);
    }
}
