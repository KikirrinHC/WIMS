<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAlmacenStockTable extends Migration
{
    public function up()
    {
        Schema::table('almacen_stock', function (Blueprint $table) {
            $table->unsignedBigInteger('sucursals_id')->nullable();
            $table->foreign('sucursals_id', 'sucursals_fk_8168750')->references('id')->on('sucursals');
            $table->unsignedBigInteger('cat_tallas_id')->nullable();
            $table->foreign('cat_tallas_id', 'cat_tallas_fk_8168751')->references('id')->on('cat_tallas');
        });
    }
}
