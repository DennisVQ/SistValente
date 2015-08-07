<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddforeignsTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::table('areas', function($table){
                    $table->foreign('jefe_id')->references('id')->on('usuarios')->onDelete('set null')->onUpdate('cascade');
             });

            Schema::table('usuarios', function($table){
                    $table->foreign('organizacion_id')->references('id')->on('organizaciones')->onDelete('set null')->onUpdate('cascade');
                    $table->foreign('area_id')->references('id')->on('areas')->onDelete('set null')->onUpdate('cascade');
             });

            Schema::table('movimientos', function($table){
                $table->foreign('cliente_id')->references('id')->on('usuarios')->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('trabajador_id')->references('id')->on('usuarios')->on('usuarios')->onDelete('set null')->onUpdate('cascade');
             });
	}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::table('areas', function($table)
             {
                 $table->dropForeign('areas_jefe_id_foreign');
             });

            Schema::table('usuarios', function($table)
             {
                 $table->dropForeign('usuarios_organizacion_id_foreign');
                 $table->dropForeign('usuarios_area_id_foreign');
             });

            Schema::table('movimientos', function($table)
             {
                 $table->dropForeign('movimientos_cliente_id_foreign');
                 $table->dropForeign('movimientos_trabajador_id_foreign');
             });
	}
}
