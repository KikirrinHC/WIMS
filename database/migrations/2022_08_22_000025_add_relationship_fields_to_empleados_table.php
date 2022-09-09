<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEmpleadosTable extends Migration
{
    public function up()
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->unsignedBigInteger('sucursal_id')->nullable();
            $table->foreign('sucursal_id', 'sucursal_fk_7180404')->references('id')->on('sucursals');
        });
    }
}
