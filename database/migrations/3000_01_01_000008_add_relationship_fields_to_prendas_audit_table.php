<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPrendasAuditTable extends Migration
{
    public function up()
    {
        Schema::table('prendas_audit', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_8888888')->references('id')->on('users');
            $table->unsignedBigInteger('prendas_id')->nullable();
            $table->foreign('prendas_id', 'prendas_fk_9168851')->references('id')->on('prendas');
        });
    }
}
