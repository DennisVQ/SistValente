<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::table('usuarios', function($table){
               $table->create();
               $table->increments('id');
               $table->string('tipo', 20)->nullable();
               $table->string('nombre_completo', 50)->unique();
               $table->string('tratamiento', 10)->nullable();
               $table->string('nombre_primero', 20)->nullable();
               $table->string('nombres_sgtes', 50)->nullable();
               $table->string('apellido_pat', 20)->nullable();
               $table->string('apellido_mat', 20)->nullable();
               $table->string('apodo', 20)->nullable();
               $table->string('dni', 8)->unique()->nullable();
               $table->string('sexo', 10)->nullable();
               $table->date('fecha_nac')->nullable();
               $table->String('direccion', 70)->nullable();              
               $table->string('telefono', 20)->nullable();
               $table->string('celular1', 20)->nullable();
               $table->string('celular2', 20)->nullable();
               $table->string('email', 50)->nullable();
               $table->integer('organizacion_id')->unsigned()->nullable();
               /*$table->foreign('empresa_id')->references('id')->on('empresas');*/
               $table->integer('area_id')->unsigned()->nullable();
               /*$table->foreign('area_id')->references('id')->on('areas');*/
               $table->string('cargo', 20)->nullable();
               $table->decimal('salario', 6, 2)->nullable();
               $table->date('fecha_ingreso')->nullable();
               $table->string('username', 20)->unique()->nullable();
               $table->string('password', 255)->nullable();
               $table->decimal('limite_credito', 6 , 2)->nullable()->default(0);               
               $table->boolean('activo')->default(1);
               $table->string('remember_token', 100)->nullable();
               $table->timestamps();
            });

          /*
          Ejecutar en terminal los sgte para aplicar solo esta migracion
          php artisan migrate --path=app/database/migrations/2014_09_10_142036_create_usuarios_table.php
          */
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuarios');
	}

}
