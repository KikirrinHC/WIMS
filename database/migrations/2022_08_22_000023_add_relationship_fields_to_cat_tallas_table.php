<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCatTallasTable extends Migration
{
    public function up()
    {
        Schema::table('cat_tallas', function (Blueprint $table) {
            $table->unsignedBigInteger('tipoprenda_id')->nullable();
            $table->foreign('tipoprenda_id', 'tipoprenda_fk_7180993')->references('id')->on('cat_tiposprendas');
        });
    }
}
