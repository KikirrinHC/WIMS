<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatTallasTable extends Migration
{
    public function up()
    {
        Schema::create('cat_tallas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('talla');
            $table->string('estatus');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
