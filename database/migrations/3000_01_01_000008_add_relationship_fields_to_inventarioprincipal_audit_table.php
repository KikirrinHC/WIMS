<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToInventarioprincipalAuditTable extends Migration
{
    public function up()
    {
        Schema::table('inventarioprincipal_audit', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9168751')->references('id')->on('users');
            $table->unsignedBigInteger('inventario_id')->nullable();
            $table->foreign('inventario_id', 'inventario_fk_9168751')->references('id')->on('inventarioprincipal');
        });
    }
}
