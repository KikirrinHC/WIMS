<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSucursalsTable extends Migration
{
    public function up()
    {
        Schema::table('sucursals', function (Blueprint $table) {
            $table->unsignedBigInteger('agencia_id')->nullable();
            $table->foreign('agencia_id', 'agencia_fk_7168750')->references('id')->on('agencia');
            $table->unsignedBigInteger('zona_id')->nullable();
            $table->foreign('zona_id', 'zona_fk_7168751')->references('id')->on('zonas');
        });
    }
}
