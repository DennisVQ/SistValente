<?php

class AreaTableSeeder extends Seeder {
 
    public function run()
    {        
        $areas = [
            [
            'tipo' => 'Ventas',
            'nombre' => 'Punto de Venta HMA',
            'direccion' => 'Dentro del Hospital Maria Auxiliadora',
            'piso' => 'Primer',
            'piso_seccion' => 'Patio de Comidas',
            'anexo1' => '3185',
            'telefono1' => null,
            'telefono2' => null            
            ],

            [
            'tipo' => 'Produccion',
            'nombre' => 'Cocina',
            'direccion' => 'Calle Arturo Suarez 1193, SJM',
            'piso' => null,
            'piso_seccion' => null,
            'anexo1' => null,                 
            'telefono1' => '990151030',
            'telefono2' => '2764475'
            ]

            /*
            Hacer para ambas tuplas un update con
            'jefe_id' => AquivaCodigo
            */
            /*
            [
            'tipo' => 'Ventas o Produccion o Logistica o Administracion o Gestion (Direccion) o RRHH o Comercial (Marketing) o Contabilidad y Finanzas o Aspectos Legales',
            'nombre' => 'Cafeteria Valente',
            'direccion' => 'Dentro del Hospital Maria Auxiliadora',
            'piso' => 'San Juan de Miraflores',
            'piso_seccion' => '2171818*3185',
            'anexo1' => 'cafeteriavalente@gmail.com',
            'anexo2' => '',
            'telefono1' => '',
            'telefono2' => '',
            'jefe_id' => '',
            'activo' => 1 
            ],
            */
        ];

        DB::table('areas')->insert($areas);
    }
}