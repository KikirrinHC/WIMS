<?php

return [
    'userManagement' => [
        'title'          => 'Gestión de Usuarios',
        'title_singular' => 'Gestión de Usuarios',
    ],
    'permission' => [
        'title'          => 'Permisos',
        'title_singular' => 'Permiso',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Título',
            'title_helper'      => ' ',
            'module'             => 'Módulo',
            'module_helper'      => ' ',
            'created_at'        => 'Fecha de creación',
            'created_at_helper' => ' ',
            'updated_at'        => 'Fecha de actualización',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Fecha de eliminación',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Rol',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'             => 'Título',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Fecha de creación',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Fecha de actualización',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Fecha de eliminación',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Usuarios',
        'title_singular' => 'Usuario',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Nombre',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Fecha de verificación de email',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Contraseña',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Fecha de creación',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Fecha de actualización',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Fecha de eliminación',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'auditLog' => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Fecha de creación',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Fecha de actualización',
            'updated_at_helper'   => ' ',
        ],
    ],
    'userAlert' => [
        'title'          => 'Alertas para usuarios',
        'title_singular' => 'Alerta',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'Texto de la alerta',
            'alert_text_helper' => ' ',
            'alert_link'        => 'Enlace',
            'alert_link_helper' => ' ',
            'user'              => 'Usuarios',
            'user_helper'       => ' ',
            'created_at'        => 'Fecha de creación',
            'created_at_helper' => ' ',
            'updated_at'        => 'Fecha de actualización',
            'updated_at_helper' => ' ',
        ],
    ],
    'faqManagement' => [
        'title'          => 'Guías para el usuario',
        'title_singular' => 'FAQ',
    ],
    'faqCategory' => [
        'title'          => 'Categorías',
        'title_singular' => 'Categoría',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'Categoría',
            'category_helper'   => ' ',
            'created_at'        => 'Fecha de creación',
            'created_at_helper' => ' ',
            'updated_at'        => 'Fecha de actualización',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Fecha de eliminación',
            'deleted_at_helper' => ' ',
        ],
    ],
    'faqQuestion' => [
        'title'          => 'Preguntas',
        'title_singular' => 'Pregunta',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'Categoría',
            'category_helper'   => ' ',
            'question'          => 'Pregunta',
            'question_helper'   => ' ',
            'answer'            => 'Respuesta',
            'answer_helper'     => ' ',
            'created_at'        => 'Fecha de creación',
            'created_at_helper' => ' ',
            'updated_at'        => 'Fecha de actualización',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Fecha de eliminación',
            'deleted_at_helper' => ' ',
        ],
    ],
    'estructura' => [
        'title'          => 'Organización',
        'title_singular' => 'Organización',
    ],
    'empresa' => [
        'title'          => 'Empresa',
        'title_singular' => 'Empresa',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'nombre'             => 'Nombre',
            'nombre_helper'      => ' ',
            'logo'               => 'Logo',
            'logo_helper'        => ' ',
            'razonsocial'        => 'Razón social',
            'razonsocial_helper' => ' ',
            'rfc'                => 'RFC',
            'rfc_helper'         => ' ',
            'created_at'         => 'Fecha de creación',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Fecha de actualización',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Fecha de eliminación',
            'deleted_at_helper'  => ' ',
            'estatus'            => 'Estatus',
            'estatus_helper'     => ' ',
        ],
    ],
    'agencium' => [
        'title'          => 'Agencia',
        'title_singular' => 'Agencia',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'nombre'            => 'Nombre',
            'nombre_helper'     => ' ',
            'empresa'           => 'Empresa',
            'empresa_helper'    => ' ',
            'estatus'           => 'Estatus',
            'estatus_helper'    => ' ',
            'created_at'        => 'Fecha de creación',
            'created_at_helper' => ' ',
            'updated_at'        => 'Fecha de actualización',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Fecha de eliminación',
            'deleted_at_helper' => ' ',
        ],
    ],
    'catalogo' => [
        'title'          => 'Catálogos',
        'title_singular' => 'Catálogo',
    ],
    'zona' => [
        'title'          => 'Zonas',
        'title_singular' => 'Zona',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'nombre'             => 'Nombre',
            'nombre_helper'      => ' ',
            'descripcion'        => 'Descripción',
            'descripcion_helper' => ' ',
            'entidad'            => 'Entidad federativa',
            'entidad_helper'     => ' ',
            'estatus'            => 'Estatus',
            'estatus_helper'     => ' ',
            'created_at'         => 'Fecha de creación',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Fecha de actualización',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Fecha de eliminación',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'sucursal' => [
        'title'          => 'Sucursal',
        'title_singular' => 'Sucursal',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'nombre'            => 'Nombre',
            'nombre_helper'     => ' ',
            'agencia'           => 'Agencia',
            'agencia_helper'    => ' ',
            'zona'              => 'Zona',
            'zona_helper'       => ' ',
            'entidad'           => 'Entidad federativa',
            'entidad_helper'    => ' ',
            'municipio'         => 'Municipio',
            'municipio_helper'  => ' ',
            'direccion'         => 'Dirección',
            'direccion_helper'  => ' ',
            'latitud'           => 'Latitud',
            'latitud_helper'    => ' ',
            'longitud'          => 'Longitud',
            'longitud_helper'   => ' ',
            'estatus'           => 'Estatus',
            'estatus_helper'    => ' ',
            'created_at'        => 'Fecha de creación',
            'created_at_helper' => ' ',
            'updated_at'        => 'Fecha de actualización',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Fecha de eliminación',
            'deleted_at_helper' => ' ',
        ],
    ],
    'catTiposprenda' => [
        'title'          => 'Tipos de prendas',
        'title_singular' => 'Tipos de prenda',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'tipo'              => 'Tipo de prenda',
            'tipo_helper'       => ' ',
            'estatus'           => 'Estatus',
            'estatus_helper'    => ' ',
            'created_at'        => 'Fecha de creación',
            'created_at_helper' => ' ',
            'updated_at'        => 'Fecha de actualización',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Fecha de eliminación',
            'deleted_at_helper' => ' ',
        ],
    ],
    'catTalla' => [
        'title'          => 'Tallas',
        'title_singular' => 'Talla',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'talla'             => 'Talla',
            'talla_helper'      => ' ',
            'estatus'           => 'Estatus',
            'estatus_helper'    => ' ',
            'created_at'        => 'Fecha de creación',
            'created_at_helper' => ' ',
            'updated_at'        => 'Fecha de actualización',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Fecha de eliminación',
            'deleted_at_helper' => ' ',
            'tipoprenda'        => 'Tipo de prenda',
            'tipoprenda_helper' => ' ',
        ],
    ],
    'inventarioprincipal' => [
        'title'          => 'Inventario 5E',
        'title_singular' => 'Inventario 5E',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'cantidad'             => 'Cantidad',
            'cantidad_helper'      => ' ',
            'estatus'           => 'Estatus',
            'estatus_helper'    => ' ',
            'created_at'        => 'Fecha de creación',
            'created_at_helper' => ' ',
            'updated_at'        => 'Fecha de actualización',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Fecha de eliminación',
            'deleted_at_helper' => ' ',
        ],
    ],
    'inventario' => [
        'title'          => 'Inventarios',
        'title_singular' => 'Inventario',
    ],
    'almacen' => [
        'title'          => 'Almacenes',
        'title_singular' => 'Almacén',
    ],
    'prenda' => [
        'title'          => 'Prendas',
        'title_singular' => 'Prenda',
    ],
    'asignacion' => [
        'title'          => 'Asignaciones',
        'title_singular' => 'Asignación',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'qr'                => 'QR de la prenda',
            'qr_helper'         => ' ',
            'created_at'        => 'Fecha de creación',
            'created_at_helper' => ' ',
            'updated_at'        => 'Fecha de actualización',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Fecha de eliminación',
            'deleted_at_helper' => ' ',
            'empleado'          => 'Empleado',
            'empleado_helper'   => ' ',
        ],
    ],
    'empleado' => [
        'title'          => 'Empleados',
        'title_singular' => 'Empleado',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'nombre'            => 'Nombre',
            'nombre_helper'     => 'Ejemplo: Luis Sánchez Gómez',
            'sucursal'          => 'Sucursal',
            'sucursal_helper'   => ' ',
            'created_at'        => 'Fecha de creación',
            'created_at_helper' => ' ',
            'updated_at'        => 'Fecha de actualización',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Fecha de eliminación',
            'deleted_at_helper' => ' ',
            'clave'             => 'Clave',
            'clave_helper'      => ' ',
        ],
    ],
];
