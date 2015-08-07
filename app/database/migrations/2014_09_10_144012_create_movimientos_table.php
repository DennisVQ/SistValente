<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::table('movimientos', function($table){
               $table->create();
               $table->increments('id');
               $table->integer('cliente_id')->unsigned();
                /*$table->foreign('cliente_id')->references('id')->on('usuarios')->onDelete('cascade');*/
               $table->integer('trabajador_id')->unsigned()->nullable();
                /*$table->foreign('trabajador_id')->references('id')->on('usuarios');*/
               $table->string('tipo', 20);
               $table->decimal('monto', 6 , 2);
               $table->string('detalle')->nullable();
               $table->string('nota', 50)->nullable();
               $table->string('origen_mov', 10);
               $table->smallInteger('cont_modifs')->default(0);
               $table->boolean('activo')->default(1);
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
		Schema::drop('movimientos');
	}

}
