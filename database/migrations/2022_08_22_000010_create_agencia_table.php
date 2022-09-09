<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgenciaTable extends Migration
{
    public function up()
    {
        Schema::create('agencia', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('estatus')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
