<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->float('costo_total');
            $table->integer('cantidad');
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')
                    ->references('id')
                    ->on('clientes')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
                    $table->string('precio');
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')
                    ->references('id')
                    ->on('categorias')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicios');
    }
}
