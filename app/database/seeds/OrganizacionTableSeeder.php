<?php

class OrganizacionTableSeeder extends Seeder {
 
    public function run()
    {
        $organizaciones = [
            [
            'tipo' => 'Con Fines de Lucro',
            'tipo_tamaño' => 'MicroEmpresa', 
            'nombre' => 'Cafeteria Valente',
            'ruc' => '10084047070',
            'direccion' => 'Dentro del Hospital Maria Auxiliadora',
            'distrito' => 'San Juan de Miraflores',
            'telefono1' => '2171818*3185',
            'email' => 'cafeteriavalente@gmail.com'
            ],

            //Fatla Crear Campo si es del estado o no
            [
            'tipo' => 'Sin Fines de Lucro',
            'tipo_tamaño' => 'Grande',
            'nombre' => 'Hospital de Maria Auxiliadora',
            'ruc' => '20162041291',
            'direccion' => 'AV Miguel Iglesias 968 ',
            'distrito' => 'San Juan de Miraflores',
            'telefono1' => '2171818',
            'email' => 'hma@hma.gob.pe'
            ]

            /*
            [
            'tipo' => 'Con Fines de Lucro o Si Fines de Lucro',
            'tipo_tamaño' => 'MicroEmpresa o Pequeña Empresa o Enpresa', 
            'nombre' => 'Cafeteria Valente',
            'ruc' => '10084047070',
            'direccion' => 'Dentro del Hospital Maria Auxiliadora',
            'distrito' => 'San Juan de Miraflores',
            'telefono1' => '2171818*3185',
            'telefono2' => '',
            'correo' => 'cafeteriavalente@gmail.com',
            'web' => '',
            //true es 1 false es 0
            'activo' => 1 
            ],
			*/
        ];

        DB::table('organizaciones')->insert($organizaciones);
    }
}