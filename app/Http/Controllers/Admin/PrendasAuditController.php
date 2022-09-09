<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePrendaAuditRequest;
use App\Http\Requests\UpdatePrendaAuditRequest;
use App\Models\PrendaAudit;

use Gate;

use stdClass;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PrendasAuditController extends Controller
{

    public function store(StorePrendaAuditRequest $request)
    {
        $prenda = PrendaAudit::create($request->all());
        return redirect()->route('admin.prendas_audit.index');
    }
}
