<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/test', function(){
    $users = Usuario::all();
    foreach($users as $user){
        echo $user->username.'<br>';
    }
})->before('auth');

Route::resource('prueba', 'MovimientoController@prueba');

/*------------------------------------------------------------*/


/*Route::get('/', function()
{
    return View::make('hello');
});*/


Route::get('/', array('as' => 'home', function()
{
    return View::make('sesion.formLogueo');
    /*return View::make('hello');*/

}));

/*Route::filter('auth', function(){
    if (Auth::guest()) return Redirect::to('login')
});
*/


// Nos indica que las rutas que están dentro de él sólo serán mostradas si antes el usuario se ha autenticado.
Route::group(array('before' => 'auth'), function()
{

    Route::get('/', function() { return View::make('index'); });

    //Rutas solo para Admin
    Route::group(array('before' => 'admin'), function(){

        Route::resource('admin/usuarios', 'Admin_UsuarioController');

        Route::resource('organizaciones', 'OrganizacionController');

        Route::resource('areas', 'AreaController');

        Route::resource('usuarios', 'UsuarioController');

        Route::resource('movimientos', 'MovimientoController');

        //Obtener el Datatable que Lista a los Clientes, as = alias
        Route::get('dtClientes', array('as'=>'dtClientes', 'uses'=>'UsuarioController@getDT_Clientes'));

        //Obtener el Datatable que Lista a los Usuarios        
        Route::get('dtUsuarios', array('as'=>'dtUsuarios', 'uses'=>'UsuarioController@getDT_Usuarios'));        

        //Obtener el Datatable que Lista los Movimientos del Cliente al Administrador
        //'as' = nombre para la ruta /
        Route::get('movimientos/cliente/{cliente_id}', array('as'=>'movimientos.admin', 'uses'=>'MovimientoController@showAll_Admin'));

        Route::get('dtMovimientos_Admin/{cliente_id}', array('as'=>'dtMovimientos.admin', 'uses'=>'MovimientoController@getDT_Admin'));
    });
    
    Route::get('mis/movimientos', array('as'=>'movimientos.cliente', 'uses'=>'MovimientoController@showAll_Cliente'));

    Route::get('dtMovimientos_Cliente/{cliente_id}', array('as'=>'dtMovimientos.cliente', 'uses'=>'MovimientoController@getDT_Cliente'));

    Route::get('mi/perfil', array('as'=>'mi.perfil', 'uses'=>'UsuarioController@show_Usuario_Auth'));
});


Route::any('login1', 'auth@login');

Route::get('logout1', 'auth@logout');


Route::get('logout', 'SesionController@destroy');
Route::get('login', 'SesionController@create');

Route::resource('sesiones', 'SesionController', array('only' => array('index', 'create', 'destroy', 'store'))); 

Route::get('registro', function()
{
    $registros = json_encode(DB::select('call sp_estado_clientes'));

    $registros1 = Usuario::all(array('id', 'nombre_completo'));
    $registros2 = Datatable::collection($registros1);
    return $registros;
});

/*Route::resource('users', 'UsersController');
Route::get('api/users', array('as'=>'api.users', 'uses'=>'UsersController@getDatatable'));*/

/*Route::model('usuarios', 'Usuario');*/

/*
Route::get('admin', array{'before' => 'auth', function()
{
    return View::make('admin.dashboard');
});
*/