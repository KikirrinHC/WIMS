<?php


namespace App\Models;

class mensajero
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
        echo ("<br><pre>");
        print_r($arreglo);
        echo ("</pre>");
    }
}
