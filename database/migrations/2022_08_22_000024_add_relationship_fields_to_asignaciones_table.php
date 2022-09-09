<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAsignacionesTable extends Migration
{
    public function up()
    {
        Schema::table('asignaciones', function (Blueprint $table) {
            $table->unsignedBigInteger('empleado_id')->nullable();
            $table->foreign('empleado_id', 'empleado_fk_7180408')->references('id')->on('empleados');
            $table->unsignedBigInteger('cat_tallas_id')->nullable();
            $table->foreign('cat_tallas_id', 'cat_tallas_fk_7180408')->references('id')->on('cat_tallas');
            $table->unsignedBigInteger('cat_tiposprendas_id')->nullable();
            $table->foreign('cat_tiposprendas_id', 'cat_tiposprendas_fk_7180408')->references('id')->on('cat_tiposprendas');
            $table->unsignedBigInteger('sucursals_id')->nullable();
            $table->foreign('sucursals_id', 'sucursals_fk_9133351')->references('id')->on('sucursals');
        });
    }
}
