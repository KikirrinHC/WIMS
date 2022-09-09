<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrendaAudit extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'prendas_audit';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'qr',
        'descripcion',
        'dias_uso',
        'accion',
        'prendas_id',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];



    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
