<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAsignacionesAuditTable extends Migration
{
    public function up()
    {
        Schema::table('asignaciones_audit', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_8888751')->references('id')->on('users');
            $table->unsignedBigInteger('asignaciones_id')->nullable();
            $table->foreign('asignaciones_id', 'asignaciones_fk_8888751')->references('id')->on('asignaciones');
            $table->unsignedBigInteger('sucursals_id')->nullable();
            $table->foreign('sucursals_id', 'sucursals_fk_9168851')->references('id')->on('sucursals');
            $table->unsignedBigInteger('cat_tiposprendas_id')->nullable();
            $table->foreign('cat_tiposprendas_id', 'cat_tiposprendas_fk_9168851')->references('id')->on('cat_tiposprendas');
            $table->unsignedBigInteger('cat_tallas_id')->nullable();
            $table->foreign('cat_tallas_id', 'cat_tallas_fk_9168851')->references('id')->on('cat_tallas');
            $table->unsignedBigInteger('empleados_id')->nullable();
            $table->foreign('empleados_id', 'empleados_fk_9168851')->references('id')->on('empleados');
        });
    }
}
