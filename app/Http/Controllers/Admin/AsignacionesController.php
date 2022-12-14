<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\mensajero;
use App\Http\Requests\MassDestroyAsignacioneRequest;
use App\Http\Requests\StoreAsignacioneRequest;
use App\Http\Requests\UpdateAsignacioneRequest;
use App\Models\Almacen;
use App\Models\AlmacenAudit;
use App\Models\Asignacione;
use App\Models\AsignacionesAudit;
use App\Models\CatTiposprenda;
use App\Models\Empleado;
use App\Models\Prenda;
use App\Models\PrendaAudit;
use App\Models\Sucursal;
use Gate;

use stdClass;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AsignacionesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('asignacion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asignaciones = Asignacione::with(['empleado'])->get();

        $empleados = Empleado::get();

        return view('admin.asignaciones.index', compact('asignaciones', 'empleados'));
    }

    public function create(stdClass $message)
    {
        abort_if(Gate::denies('asignacion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $Sucursal = new Sucursal();
        $sucursales = $Sucursal->getSucursalesConEmpleados();
        return view('admin.asignaciones.create', compact('sucursales', 'message'));
    }

    public function store(StoreAsignacioneRequest $request)
    {
        mensajero::mensajeConsola("Stroe es llamado");

        $message = new stdClass();
        $Sucursal = new Sucursal();
        $sucursales = $Sucursal->getSucursalesConEmpleados();

        $classEmpleado = new Empleado();
        $empleado = $classEmpleado->getEmpleado($request->input('empleado_id'));

        $almacenClass = new Almacen();
        $almacen = $almacenClass->getAlmacenPorAtributos($empleado->sucursal_id, $request->input('cat_tallas_id'), $request->input('cat_tiposprendas_id'));
        $almacen = $almacen[0];


        if ($almacen->cantidad > 0) {
            $classAsignaciones = new Asignacione();
            $asignacion = $classAsignaciones->crearAsignacion($empleado, $request);

            if ($asignacion->count() > 0) {
                $registroAlmacen = $almacenClass->extraerPrenda($almacen, $request, "Substract for asign");

                if ($registroAlmacen) {
                    $classPrenda = new Prenda();
                    $prenda = $classPrenda->getPrendaPorQR($request->input('qr'));

                    if ($prenda->count() > 0) {
                        mensajero::mensajeConsola("s?? exist??a la prenda " . $request->input('qr') . " en la tabla prendas");

                        $prenda = $prenda[0];

                        if ($prenda->estatus == "Disponible") {
                            mensajero::mensajeConsola("S?? exist??a la prenda en la tabla prendas, pero estaba disponible");

                            //DOCUMENTACI??N   Aqu?? se actualiza la prenda y se inicia el conteo de sus d??as de uso
                            $requestActualizaPrenda = [];
                            $requestActualizaPrenda['qr'] = $request->input('qr');
                            $requestActualizaPrenda['cat_tallas_id'] = $request->input('cat_tallas_id');
                            $requestActualizaPrenda['cat_tiposprendas_id'] =  $request->input('cat_tiposprendas_id');
                            $requestActualizaPrenda['dias_uso'] = $prenda->dias_uso;
                            $requestActualizaPrenda['asignaciones_id'] = $asignacion->id;
                            $requestActualizaPrenda['user_id'] = auth()->user()->id;
                            $requestActualizaPrenda['estatus'] = "Reuso";
                            $requestActualizaPrenda['comentario'] = "Se reasign?? la prenda QR " . $request->input('qr') . " al empleado " . $asignacion->empleado_id;

                            $actualiza = $classPrenda->updatePrenda($requestActualizaPrenda, $prenda, "Reuso");
                            mensajero::mensajeConsola("Se asign?? correctamente una prenda que ya estaba existente y se puso en reuso");
                            return redirect()->route('admin.asignaciones.index');
                        } else {
                            $message->title = "Error al registrar la prenda";
                            $message->msj = "La asignaci??n se registr?? correctamente, pero la prenda no se pudo asociar, pues no estaba disponible.";
                            $message->type = "danger";
                            mensajero::mensajeConsola("Ocurri?? un error, la prenda existe pero no est?? disponible para asignarse");
                            return view('admin.asignaciones.create', compact('sucursales', 'message'));
                        }
                    } else {
                        mensajero::mensajeConsola("No exist??a la prenda " . $request->input('qr') . " en la tabla prendas");

                        $registroPrenda = $classPrenda->createPrenda($request->all(), $asignacion, "Asignaci??n");
                        if ($registroPrenda->count() > 0) {
                            return redirect()->route('admin.asignaciones.index');
                        } else {
                            $message->title = "Error al registrar la prenda";
                            $message->msj = "La asignaci??n se registr?? correctamente, pero la prenda no se pudo registrar.";
                            $message->type = "danger";
                            mensajero::mensajeConsola("Ocurri?? un error, la prenda no pudo crearse en la tabla prendas");
                            return view('admin.asignaciones.create', compact('sucursales', 'message'));
                        }
                    }
                } else {
                    $message->title = "Asignaci??n incorrecta";
                    $message->msj = "La asignaci??n no se pudo completar debido a que no cuenta con prendas suficientes en el almac??n.";
                    $message->type = "danger";
                    mensajero::mensajeConsola("Ocurri?? un error, no se pudo extraer la prenda del almac??n");

                    return view('admin.asignaciones.create', compact('sucursales', 'message'));
                }
            } else {
                $message->title = "Asignaci??n incorrecta";
                $message->msj = "La asignaci??n no se pudo registrar.";
                $message->type = "danger";
                mensajero::mensajeConsola("Ocurri?? un error, la asignaci??n no pudo crearse en la tabla asignaciones");

                return view('admin.asignaciones.create', compact('sucursales', 'message'));
            }
        }
    }

    public function edit(Asignacione $asignacione)
    {
        abort_if(Gate::denies('asignacion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classAsignaciones = new Asignacione();

        $asignacion = $classAsignaciones->getAsignacion($asignacione->id);

        return view('admin.asignaciones.edit', compact('asignacion'));
    }


    public function update(UpdateAsignacioneRequest $request, Asignacione $asignacione)
    {
        $message = new stdClass();
        mensajero::mensajeConsola("vino al m??todo update");
        $classAsignaciones = new Asignacione();
        $asignacion = $classAsignaciones->getAsignacion($asignacione->id);
        $updateAsignacion = $classAsignaciones->updateAsignacion($request->except('_method', '_token'), $asignacion, "Modificaci??n");

        if ($updateAsignacion) {

            $classPrenda = new Prenda();
            $prenda = $classPrenda->getPrendaPorQRyAsignacion($asignacion->qr, $asignacion->id);

            if ($prenda->count() > 0) {
                $prenda = $prenda[0];
                mensajero::mensajeConsola("s?? existe la prenda " . $asignacion->qr . " en la tabla prendas");


                if ($prenda->estatus == "Asignada" || $prenda->estatus == "Reuso") {
                    mensajero::mensajeConsola("S?? exist??a la prenda en la tabla prendas con estatus " . $prenda->estatus);
                    $datos = [];
                    $datos['qr'] = $request->input('qr');
                    $datos['comentario'] = "Se modific?? el QR anterior " . $asignacion->qr . " por el QR nuevo " . $request->input('qr');
                    $actualiza = $classPrenda->updatePrenda($datos, $prenda, "Modificaci??n");
                    return redirect()->route('admin.asignaciones.index');
                } else {
                    $message->title = "Actualizaci??n incorrecta";
                    $message->msj = "El QR de la prenda no pudo modificarse porque la prenda tiene estatus " . $prenda->estatus . " el cual no es v??lido al no estar asignada.";
                    $message->type = "danger";
                    mensajero::mensajeConsola("Ocurri?? un error, el QR de la prenda no pudo modificarse porque la prenda tiene estatus " . $prenda->estatus . " el cual no es v??lido al no estar asignada.");

                    return view('admin.asignaciones.edit', compact('asignacion', 'message'));
                }
            } else {
                $message->title = "Actualizaci??n incorrecta";
                $message->msj = "El QR de la prenda no pudo modificarse en la tabla prendas.";
                $message->type = "danger";
                mensajero::mensajeConsola("Ocurri?? un error, el QR de la prenda no pudo modificarse en la tabla prendas");

                return view('admin.asignaciones.edit', compact('asignacion', 'message'));
            }
        } else {
            $message->title = "Actualizaci??n incorrecta";
            $message->msj = "El QR de la prenda asignada no pudo modificarse en la tabla asignaciones.";
            $message->type = "danger";
            mensajero::mensajeConsola("Ocurri?? un error, el QR de la prenda asignada no pudo modificarse en la tabla asignacionese");

            return view('admin.asignaciones.edit', compact('asignacion', 'message'));
        }
    }

    public function cambio($id)
    {
        abort_if(Gate::denies('asignacion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classAsignaciones = new Asignacione();

        $asignacion = $classAsignaciones->getAsignacion($id);


        return view('admin.asignaciones.change', compact('asignacion'));
    }

    public function updateCambio(UpdateAsignacioneRequest $request, $id)
    {

        $message = new stdClass();
        mensajero::mensajeConsola("vino al m??todo update");


        $classAsignaciones = new Asignacione();
        $asignacionOriginal = $classAsignaciones->getAsignacion($id);
        $requestActualizaAsignacion = $request->except('_method', '_token', 'tipocambio', 'cat_tallas_id2');
        $requestActualizaAsignacion['descripcion'] = "Cambio de prenda " . $asignacionOriginal->qr . " por prenda " . $request->input('qr') . " por: " . $request->input('descripcion');

        $updateAsignacion = $classAsignaciones->updateAsignacion($requestActualizaAsignacion, $asignacionOriginal, "Cambio");
        if ($updateAsignacion) {
            mensajero::mensajeConsola("se actualiz?? correctamente la asignaci??n");

            $asignacionesAudit = AsignacionesAudit::create([
                'qr' => $request->input('qr'),
                'accion' => "Asignaci??n por cambio de prenda",
                'descripcion' => "Se asigna la prenda QR " . $request->input('qr') . " por cambio de la prenda " . $asignacionOriginal->qr . " por: " . $request->input('descripcion'),
                'empleados_id' => $request->input('empleado_id'),
                'sucursals_id' => $request->input('sucursals_id'),
                'cat_tallas_id' => $request->input('cat_tallas_id'),
                'cat_tiposprendas_id' => $request->input('cat_tiposprendas_id'),
                'asignaciones_id' => $asignacionOriginal->id,
                'user_id' => auth()->user()->id,
            ]);

            //DOCUMENTACI??N   Aqu?? se hace la actualizaci??n de los inventarios, quit??ndole al nuevo y sum??ndole al anterior
            if ($request->input('tipocambio') == "diferente") {

                $almacenClass = new Almacen();
                $almacen = $almacenClass->getAlmacenPorAtributos($request->input('sucursals_id'), $request->input('cat_tallas_id'), $request->input('cat_tiposprendas_id'));
                $almacen = $almacen[0];
                $registroAlmacen = $almacenClass->extraerPrenda($almacen, $request, "Substract for change");

                $almacen = $almacenClass->getAlmacenPorAtributos($asignacionOriginal->sucursals_id, $asignacionOriginal->cat_tallas_id, $asignacionOriginal->cat_tiposprendas_id);
                $almacen = $almacen[0];
                $registroAlmacen = $almacenClass->ingresarPrenda($almacen, $request, "Add for change");
            }


            $classPrenda = new Prenda();
            $prendaQueSeEntrega = $classPrenda->getPrendaPorQRyAsignacion($asignacionOriginal->qr, $asignacionOriginal->id);


            if ($prendaQueSeEntrega->count() > 0) {
                mensajero::mensajeConsola("la prenda que se quiere asignar si existe");

                $prendaQueSeEntrega = $prendaQueSeEntrega[0];
                echo ("<br>s?? hab??a prendas");

                if ($prendaQueSeEntrega->estatus == "Asignada" || $prendaQueSeEntrega->estatus == "Reuso") {
                    $datos['qr'] = $prendaQueSeEntrega->qr;
                    $datos['estatus'] = "Disponible";
                    $datos['comentario'] = "Se realiz?? un cambio de la prenda " . $asignacionOriginal->qr . " por la prenda " . $request->input('qr');
                    $updatePrenda = $classPrenda->updatePrenda($datos, $prendaQueSeEntrega, "Cambio de prenda");

                    if ($updatePrenda) {
                        $prendaNuevaRegistrada = $classPrenda->getPrendaPorQRyEstatus($request->input('qr'), "Disponible");

                        if ($prendaNuevaRegistrada->count() > 0) {
                            mensajero::mensajeConsola("Encuentra la prenda para reusar");
                            $prendaNuevaRegistrada = $prendaNuevaRegistrada[0];
                            $datosNuevaPrenda = [];
                            $datosNuevaPrenda['qr'] = $prendaNuevaRegistrada->qr;
                            $datosNuevaPrenda['estatus'] = "Reuso";
                            $datosNuevaPrenda['comentario'] = "Se reasigna la prenda " . $request->input('qr') . " por la prenda " . $prendaQueSeEntrega->qr;
                            $actualiza = $classPrenda->updatePrenda($datosNuevaPrenda, $prendaNuevaRegistrada, "Asignaci??n");
                            if ($actualiza) {
                                return redirect()->route('admin.asignaciones.index');
                            } else {
                                $message->title = "Cambio de prenda incorrecto";
                                $message->msj = "Se realiz?? el cambio en la asignaci??n " . $asignacionOriginal->id . ", pero no se pudo modificar la prenda existente " . $request->input('qr') . " en la tabla prendas";
                                $message->type = "danger";
                                mensajero::mensajeConsola("Ocurri?? un error, no se pudo modificar la prenda existente " . $request->input('qr') . " en la tabla prendas");
                                return view('admin.asignaciones.create', compact('sucursales', 'message'));
                            }
                        } else {
                            mensajero::mensajeConsola("No encuentra la prenda, as?? que la crea");


                            $registroPrenda = $classPrenda->createPrenda($request->all(), $asignacionOriginal, "Asignaci??n");
                            if ($registroPrenda->count() > 0) {
                                return redirect()->route('admin.asignaciones.index');
                            } else {
                                $message->title = "Cambio de prenda incorrecto";
                                $message->msj = "Se realiz?? el cambio en la asignaci??n " . $asignacionOriginal->id . ", pero no se pudo crear la nueva prenda " . $request->input('qr') . " en la tabla prendas";
                                $message->type = "danger";
                                mensajero::mensajeConsola("Ocurri?? un error, no se pudo crear la nueva prenda " . $request->input('qr') . " en la tabla prendas");
                                return view('admin.asignaciones.create', compact('sucursales', 'message'));
                            }
                        }
                    } else {
                        $message->title = "Cambio de prenda incorrecto";
                        $message->msj = "Se realiz?? el cambio en la asignaci??n " . $asignacionOriginal->id . ", pero no se pudo cambiar el estatus a la prenda " . $prendaQueSeEntrega->qr;
                        $message->type = "danger";
                        mensajero::mensajeConsola("Ocurri?? un error, no se pudo cambiar el estatus como 'Disponible' a la prenda " . $prendaQueSeEntrega->qr);
                        return view('admin.asignaciones.change', compact('asignacionOriginal', 'message'));
                    }
                } else {
                    $message->title = "Cambio de prenda incorrecto";
                    $message->msj = "Se realiz?? el cambio en la asignaci??n " . $asignacionOriginal->id . ", pero la prenda " . $prendaQueSeEntrega->qr . " ten??a estatus " . $prendaQueSeEntrega->estatus . " el cual no es v??lido";
                    $message->type = "danger";
                    mensajero::mensajeConsola("Ocurri?? un error, la prenda " . $prendaQueSeEntrega->id . " existe pero no tiene estatus v??lido= " . $prendaQueSeEntrega->estatus);
                    return view('admin.asignaciones.change', compact('asignacionOriginal', 'message'));
                }
            } else {
                $message->title = "Cambio de prenda incorrecto";
                $message->msj = "Se realiz?? el cambio en la asignaci??n " . $asignacionOriginal->id . ", pero la prenda " . $asignacionOriginal->qr . " no se encontr?? en la tabla prendas";
                $message->type = "danger";
                mensajero::mensajeConsola("Ocurri?? un error, no exist??a la prenda " . $asignacionOriginal->qr . " en la tabla prendas");
                return view('admin.asignaciones.change', compact('asignacionOriginal', 'message'));
            }
        } else {
            $message->title = "Cambio de prenda incorrecto";
            $message->msj = "No se pudo modificar la asignaci??n " . $asignacionOriginal->id . " de la prenda " . $asignacionOriginal->qr;
            $message->type = "danger";
            mensajero::mensajeConsola("Ocurri?? un error, no se pudo modificar la asignaci??n " . $asignacionOriginal->id . " de la prenda " . $asignacionOriginal->qr);

            return view('admin.asignaciones.change', compact('asignacionOriginal', 'message'));
        }
    }

    public function show(Asignacione $asignacione)
    {
        abort_if(Gate::denies('asignacion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asignacione->load('empleado');

        return view('admin.asignaciones.show', compact('asignacione'));
    }

    public function destroy(Asignacione $asignacione)
    {
        abort_if(Gate::denies('asignacion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asignacione->delete();

        return back();
    }

    public function massDestroy(MassDestroyAsignacioneRequest $request)
    {
        Asignacione::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
