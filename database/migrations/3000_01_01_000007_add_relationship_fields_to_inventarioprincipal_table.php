<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToInventarioprincipalTable extends Migration
{
    public function up()
    {
        Schema::table('inventarioprincipal', function (Blueprint $table) {
            $table->unsignedBigInteger('cat_tallas_id')->nullable();
            $table->foreign('cat_tallas_id', 'cat_tallas_fk_9168751')->references('id')->on('cat_tallas');
            $table->unsignedBigInteger('cat_tiposprendas_id')->nullable();
            $table->foreign('cat_tiposprendas_id', 'cat_tiposprendas_fk_8868751')->references('id')->on('cat_tiposprendas');
        });
    }
}
