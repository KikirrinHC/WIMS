<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre')->unique();
            $table->string('razonsocial')->nullable();
            $table->string('rfc')->nullable();
            $table->string('estatus')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
