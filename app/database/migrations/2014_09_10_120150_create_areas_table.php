<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::table('areas', function($table){
               $table->create();
               $table->increments('id');
               $table->string('tipo', 20)->unique()->nullable();
               $table->string('nombre', 20)->unique();
               $table->string('direccion', 100)->nullable();
               $table->string('piso', 3)->nullable();
               $table->string('piso_seccion', 10)->nullable();
               $table->string('anexo1', 5)->nullable();
               $table->string('anexo2', 5)->nullable();
               $table->string('telefono1', 20)->nullable();
               $table->string('telefono2', 20)->nullable();
               $table->integer('jefe_id')->unsigned()->nullable();
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
		Schema::drop('areas');
	}

}
