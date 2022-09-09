<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAlmacenTable extends Migration
{
    public function up()
    {
        Schema::table('almacen', function (Blueprint $table) {
            $table->unsignedBigInteger('sucursals_id')->nullable();
            $table->foreign('sucursals_id', 'sucursals_fk_7168750')->references('id')->on('sucursals');
            $table->unsignedBigInteger('cat_tallas_id')->nullable();
            $table->foreign('cat_tallas_id', 'cat_tallas_fk_9168881')->references('id')->on('cat_tallas');
            $table->unsignedBigInteger('cat_tiposprendas_id')->nullable();
            $table->foreign('cat_tiposprendas_id', 'cat_tiposprendas_fk_9168881')->references('id')->on('cat_tiposprendas');
        });
    }
}
