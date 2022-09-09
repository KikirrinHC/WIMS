<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
                'module' => 'usuarios',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
                'module' => 'usuarios',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
                'module' => 'usuarios',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
                'module' => 'usuarios',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
                'module' => 'usuarios',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
                'module' => 'usuarios',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
                'module' => 'usuarios',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
                'module' => 'usuarios',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
                'module' => 'usuarios',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
                'module' => 'usuarios',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
                'module' => 'usuarios',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
                'module' => 'usuarios',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
                'module' => 'usuarios',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
                'module' => 'usuarios',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
                'module' => 'usuarios',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
                'module' => 'usuarios',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
                'module' => 'auditoría',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
                'module' => 'auditoría',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_create',
                'module' => 'comunicaciones',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_show',
                'module' => 'comunicaciones',
            ],
            [
                'id'    => 21,
                'title' => 'user_alert_delete',
                'module' => 'comunicaciones',
            ],
            [
                'id'    => 22,
                'title' => 'user_alert_access',
                'module' => 'comunicaciones',
            ],
            [
                'id'    => 23,
                'title' => 'faq_management_access',
                'module' => 'faq',
            ],
            [
                'id'    => 24,
                'title' => 'faq_category_create',
                'module' => 'faq',
            ],
            [
                'id'    => 25,
                'title' => 'faq_category_edit',
                'module' => 'faq',
            ],
            [
                'id'    => 26,
                'title' => 'faq_category_show',
                'module' => 'faq',
            ],
            [
                'id'    => 27,
                'title' => 'faq_category_delete',
                'module' => 'faq',
            ],
            [
                'id'    => 28,
                'title' => 'faq_category_access',
                'module' => 'faq',
            ],
            [
                'id'    => 29,
                'title' => 'faq_question_create',
                'module' => 'faq',
            ],
            [
                'id'    => 30,
                'title' => 'faq_question_edit',
                'module' => 'faq',
            ],
            [
                'id'    => 31,
                'title' => 'faq_question_show',
                'module' => 'faq',
            ],
            [
                'id'    => 32,
                'title' => 'faq_question_delete',
                'module' => 'faq',
            ],
            [
                'id'    => 33,
                'title' => 'faq_question_access',
                'module' => 'faq',
            ],
            [
                'id'    => 34,
                'title' => 'estructura_access',
                'module' => 'organización',
            ],
            [
                'id'    => 35,
                'title' => 'empresa_create',
                'module' => 'organización',
            ],
            [
                'id'    => 36,
                'title' => 'empresa_edit',
                'module' => 'organización',
            ],
            [
                'id'    => 37,
                'title' => 'empresa_show',
                'module' => 'organización',
            ],
            [
                'id'    => 38,
                'title' => 'empresa_delete',
                'module' => 'organización',
            ],
            [
                'id'    => 39,
                'title' => 'empresa_access',
                'module' => 'organización',
            ],
            [
                'id'    => 40,
                'title' => 'agencium_create',
                'module' => 'organización',
            ],
            [
                'id'    => 41,
                'title' => 'agencium_edit',
                'module' => 'organización',
            ],
            [
                'id'    => 42,
                'title' => 'agencium_show',
                'module' => 'organización',
            ],
            [
                'id'    => 43,
                'title' => 'agencium_delete',
                'module' => 'organización',
            ],
            [
                'id'    => 44,
                'title' => 'agencium_access',
                'module' => 'organización',
            ],
            [
                'id'    => 45,
                'title' => 'catalogo_access',
                'module' => 'catálogos',
            ],
            [
                'id'    => 46,
                'title' => 'zona_create',
                'module' => 'catálogos',
            ],
            [
                'id'    => 47,
                'title' => 'zona_edit',
                'module' => 'catálogos',
            ],
            [
                'id'    => 48,
                'title' => 'zona_show',
                'module' => 'catálogos',
            ],
            [
                'id'    => 49,
                'title' => 'zona_delete',
                'module' => 'catálogos',
            ],
            [
                'id'    => 50,
                'title' => 'zona_access',
                'module' => 'catálogos',
            ],
            [
                'id'    => 51,
                'title' => 'sucursal_create',
                'module' => 'organización',
            ],
            [
                'id'    => 52,
                'title' => 'sucursal_edit',
                'module' => 'organización',
            ],
            [
                'id'    => 53,
                'title' => 'sucursal_show',
                'module' => 'organización',
            ],
            [
                'id'    => 54,
                'title' => 'sucursal_delete',
                'module' => 'organización',
            ],
            [
                'id'    => 55,
                'title' => 'sucursal_access',
                'module' => 'organización',
            ],
            [
                'id'    => 56,
                'title' => 'cat_tiposprenda_create',
                'module' => 'catálogos',
            ],
            [
                'id'    => 57,
                'title' => 'cat_tiposprenda_edit',
                'module' => 'catálogos',
            ],
            [
                'id'    => 58,
                'title' => 'cat_tiposprenda_show',
                'module' => 'catálogos',
            ],
            [
                'id'    => 59,
                'title' => 'cat_tiposprenda_delete',
                'module' => 'catálogos',
            ],
            [
                'id'    => 60,
                'title' => 'cat_tiposprenda_access',
                'module' => 'catálogos',
            ],
            [
                'id'    => 61,
                'title' => 'cat_talla_create',
                'module' => 'catálogos',
            ],
            [
                'id'    => 62,
                'title' => 'cat_talla_edit',
                'module' => 'catálogos',
            ],
            [
                'id'    => 63,
                'title' => 'cat_talla_show',
                'module' => 'catálogos',
            ],
            [
                'id'    => 64,
                'title' => 'cat_talla_delete',
                'module' => 'catálogos',
            ],
            [
                'id'    => 65,
                'title' => 'cat_talla_access',
                'module' => 'catálogos',
            ],
            [
                'id'    => 66,
                'title' => 'inventarioprincipal_create',
                'module' => 'inventarios',
            ],
            [
                'id'    => 67,
                'title' => 'inventarioprincipal_edit',
                'module' => 'inventarios',
            ],
            [
                'id'    => 68,
                'title' => 'inventarioprincipal_show',
                'module' => 'inventarios',
            ],
            [
                'id'    => 69,
                'title' => 'inventarioprincipal_delete',
                'module' => 'inventarios',
            ],
            [
                'id'    => 70,
                'title' => 'inventarioprincipal_access',
                'module' => 'inventarios',
            ],
            [
                'id'    => 71,
                'title' => 'inventario_access',
                'module' => 'inventarios',
            ],
            [
                'id'    => 72,
                'title' => 'almacen_create',
                'module' => 'almacenes',
            ],
            [
                'id'    => 73,
                'title' => 'almacen_edit',
                'module' => 'almacenes',
            ],
            [
                'id'    => 74,
                'title' => 'almacen_show',
                'module' => 'almacenes',
            ],
            [
                'id'    => 75,
                'title' => 'almacen_delete',
                'module' => 'almacenes',
            ],
            [
                'id'    => 76,
                'title' => 'almacen_access',
                'module' => 'almacenes',
            ],
            [
                'id'    => 77,
                'title' => 'prenda_access',
                'module' => 'prendas',
            ],
            [
                'id'    => 78,
                'title' => 'asignacion_create',
                'module' => 'prendas',
            ],
            [
                'id'    => 79,
                'title' => 'asignacion_edit',
                'module' => 'prendas',
            ],
            [
                'id'    => 80,
                'title' => 'asignacion_show',
                'module' => 'prendas',
            ],
            [
                'id'    => 81,
                'title' => 'asignacion_delete',
                'module' => 'prendas',
            ],
            [
                'id'    => 82,
                'title' => 'asignacion_access',
                'module' => 'prendas',
            ],
            [
                'id'    => 83,
                'title' => 'empleado_create',
                'module' => 'empleados',
            ],
            [
                'id'    => 84,
                'title' => 'empleado_edit',
                'module' => 'empleados',
            ],
            [
                'id'    => 85,
                'title' => 'empleado_show',
                'module' => 'empleados',
            ],
            [
                'id'    => 86,
                'title' => 'empleado_delete',
                'module' => 'empleados',
            ],
            [
                'id'    => 87,
                'title' => 'empleado_access',
                'module' => 'empleados',
            ],
            [
                'id'    => 88,
                'title' => 'profile_password_edit',
                'module' => 'usuarios',
            ],
            [
                'id'    => 89,
                'title' => 'almacen_transfer',
                'module' => 'almacenes',
            ],
            [
                'id'    => 90,
                'title' => 'inventarioprincipal_transfer',
                'module' => 'inventarios',
            ],
        ];

        Permission::insert($permissions);
    }
}
