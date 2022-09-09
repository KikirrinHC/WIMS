<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'permissions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'module',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const MODULE_SELECT = [
        'almacenes' => 'Almacenes',
        'auditoría' => 'Auditoría',
        'catálogos' => 'Catálogos',
        'comunicaciones' => 'Comunicaciones',
        'empleados' => 'Empleados',
        'faq' => 'FAQ',
        'inventarios' => 'Inventarios',
        'organización' => 'Organización',
        'prendas' => 'Prendas',
        'usuarios'   => 'Usuarios',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
