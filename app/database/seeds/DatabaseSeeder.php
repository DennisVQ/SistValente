<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//Desactiva capa de seguridad de ingreso de datos masivos
		Eloquent::unguard();
		$this->call('OrganizacionTableSeeder');
		/*
		//mostramos el mensaje de que los usuarios se han insertado correctamente
		$this->command->info('Organnizcion table seeded!');
		*/
		$this->command->info('Organnizacion table seeded!');
		$this->call('AreaTableSeeder');
		$this->command->info('Area table seeded!');
		$this->call('UsuarioTableSeeder');
		$this->command->info('Usuario table seeded!');
		$this->call('MovimientoTableSeeder');
		$this->command->info('Movimiento table seeded!');

		/*
		Para Ejecutar todos los seeds en la consola debe ponerse lo sgte:
		    php artisan db:seed
		*/

	}

}
