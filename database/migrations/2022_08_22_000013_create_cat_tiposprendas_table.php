<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatTiposprendasTable extends Migration
{
    public function up()
    {
        Schema::create('cat_tiposprendas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipo')->unique();
            $table->string('estatus');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
