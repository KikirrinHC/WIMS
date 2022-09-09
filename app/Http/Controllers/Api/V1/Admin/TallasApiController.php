<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\CatTiposprenda;
use stdClass;

use Illuminate\Http\Resources\Json\JsonResource;

class AsignacionesResource extends JsonResource
{
    public function toArray($request)
    {
        $classEmpleado = new Empleado();
        // return $classEmpleado->getEmpleado($_GET['id']);

        return "ok";
    }
}
