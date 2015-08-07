<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizacionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::table('organizaciones', function($table){
               $table->create();
               $table->increments('id');
               $table->string('tipo', 20)->nullable();
               $table->string('tipo_tamaño', 20)->nullable();
               $table->string('nombre', 50)->unique();
               $table->string('ruc', 15)->unique()->nullable();
               $table->string('direccion', 100)->nullable();
               $table->string('distrito', 50)->nullable();
               $table->string('telefono1', 20)->nullable();
               $table->string('telefono2', 20)->nullable();
               $table->string('email', 50)->nullable();
               $table->string('web', 50)->nullable();
               $table->boolean('activo')->default(true);
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
		Schema::drop('organizaciones');
	}

}
