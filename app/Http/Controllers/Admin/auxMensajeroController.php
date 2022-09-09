<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class mensajero extends Controller
{

    public static function mensajeConsola($mensaje)
    {
        echo '<script>';
        echo 'console.log("' . $mensaje . '")';
        echo '</script>';
        echo ("<br>" . $mensaje);
    }

    public static function arregloPantalla($arreglo)
    {
        echo ("<pre>");
        print_r($arreglo);
        echo ("</pre>");
    }
}
