<?php

class UsuarioTableSeeder extends Seeder {
 
    public function run()
    {
        /*
        //Una forma de tipo Closures
        //Closures: Función que ejecuta código dentro de nuestra aplicación, creamos el código y le decimos que se ejecute en una determinada página)
        DB::table('usuarios')->insert(array(
                'username' => 'unodepiera',
                'password' => Hash::make('123456'),
                'email' => 'unodepiera@uno-de-piera.com',
                'edad' => 32
        ));
        */
        
        //De la sgte forma el requisito es ingresar la misma cantidad de argumentos
        $users = [
            [
            'tipo' => 'Dueño',
            'nombre_completo' => 'Estelita Quispe (Sra.)', 
            'tratamiento' => 'Sra.',
            'nombre_primero' => 'Eufemia',
            'nombres_sgtes' => 'Estelita',
            'apellido_pat' => 'Quispe',
            'apellido_mat' => 'Bartolo Vda. de Valente',
            'dni' => '08404707',
            'sexo' => 'femenino',
            'fecha_nac' => '1956-09-02',
            'telefono' => '2764475',
            'celular1' => '988458843',
            'celular2' => '#733001',
            'email' => 'cafeteriavalente@gmail.com',
            'organizacion_id' =>  1,
            'cargo' => 'Dueño',
            'fecha_ingreso' => '0000-00-00',
            'username' => 'Estelita',
            'password' => Hash::make('eeqbdjvq')
            ],

            [
            'tipo' => 'Dueño',
            'nombre_completo' => 'Dennis Valente (Joven)', 
            'tratamiento' => 'Joven',
            'nombre_primero' => 'Dennis',
            'nombres_sgtes' => 'Josue',
            'apellido_pat' => 'Valente',
            'apellido_mat' => 'Quispe',
            'dni' => '42845409',
            'sexo' => 'masculino',
            'fecha_nac' => '1984-12-12',
            'telefono' => '2764475',
            'celular1' => '990151031',
            'celular2' => null,            
            'email' => 'dennisvalente@hotmail.com',
            'organizacion_id' => 1,
            'cargo' => 'Dueño',
            'fecha_ingreso' => '0000-00-00',
            'username' => 'DennisVQ',
            'password' => Hash::make('eeqbdjvq')
            ],

            [
            'tipo' => 'Administrador',
            'nombre_completo' => 'Julio Huarancca (Sr.)', 
            'tratamiento' => 'Sr.',
            'nombre_primero' => 'Julio',
            'nombres_sgtes' => null,
            'apellido_pat' => 'Huarancca',
            'apellido_mat' => null,
            'dni' => null,
            'sexo' => 'masculino',
            'fecha_nac' => '0000-00-00', 
            'telefono' => null,
            'celular1' => '988458854',
            'celular2' => '#756756',
            'email' => null,            
            'organizacion_id' => 1,
            'cargo' => 'Administrador',
            'fecha_ingreso' => '0000-00-00',
            'username' => 'JulioH',
            'password' => Hash::make('eeqbdjvq')
            ],

            [
            'tipo' => 'Trabajador',
            'nombre_completo' => 'Isolina Villaseca (Srta.)', 
            'tratamiento' => 'Srta.',
            'nombre_primero' => 'Isolina',
            'nombres_sgtes' => null,
            'apellido_pat' => 'Villaseca',
            'apellido_mat' => null,
            'dni' => null,            
            'sexo' => 'femenino',
            'fecha_nac' => '0000-00-00', 
            'telefono' => null,
            'celular1' => null,
            'celular2' => null,
            'email' => null,
            'organizacion_id' => 1,
            'cargo' => 'Vendedor',
            'fecha_ingreso' => '0000-00-00',
            'username' => 'IsolinaV',
            'password' => Hash::make('eeqbdjvq')
            ]

            /*
            [
            'tipo' => 'Cliente, Trabajador, Administrador, Dueño',
            'nombre_completo' => 'Dennis Valente (Joven)', 
            'tratamiento' => 'Joven',
            'nombre_primero' => 'Dennis',
            'nombres_sgtes' => 'Josue',
            'apellido_pat' => 'Valente',
            'apellido_mat' => 'Quispe',
            'apodo'  => '',                        
            'dni' => '42845409'
            'sexo' => 'masculino'
            'fecha_nac' => '1984-12-12'
            'telefono' => '2764475'
            'celular1' => '990151031'
            'celular2' => ''
            'email' => 'dennisvalente@hotmail.com'
            'organizacion_id' => 
            'area_id' => 
            'cargo' => 'Dueño, Vendedor, Cocinero,  Administrador, Enfermero Lic., Enfemero, Doctor'
            'salario' =>
            'fecha_ingreso' => '0000-00-00'
            'username' => 'dennisvalente@hotmail.com'
            'password' => 'valebytes'
            'activo' => 
            ],
            */
        ];

        DB::table('usuarios')->insert($users);

        /*
        Para Ejecutar todos los seeds en la consola debe ponerse lo sgte:
            php artisan db:seed

            php artisan db:seed --class=UsuarioTableSeeder
        */
    }
}