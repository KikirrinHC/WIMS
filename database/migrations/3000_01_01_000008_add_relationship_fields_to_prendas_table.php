<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPrendasTable extends Migration
{
    public function up()
    {
        Schema::table('prendas', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_1234567')->references('id')->on('users');
            $table->unsignedBigInteger('asignaciones_id')->nullable();
            $table->foreign('asignaciones_id', 'asignaciones_fk_9168851')->references('id')->on('asignaciones');
            $table->unsignedBigInteger('cat_tiposprendas_id')->nullable();
            $table->foreign('cat_tiposprendas_id', 'cat_tiposprendas_fk_1111111')->references('id')->on('cat_tiposprendas');
            $table->unsignedBigInteger('cat_tallas_id')->nullable();
            $table->foreign('cat_tallas_id', 'cat_tallas_fk_1111111')->references('id')->on('cat_tallas');
        });
    }
}
