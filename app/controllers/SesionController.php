<?php

class SesionController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('sesion.index');
	}

	/*
	public function getWelcome(){
	   if(Auth::check()){
	      $user = Auth::user();
	      return View::make('auth.welcome')->with('user', $user);
	   }else{
	      return $this->getLogin();
	   }
	}
	*/
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// Verificamos que el usuario no esté autenticado
		if (Auth::check())
		{
		    // Si está autenticado lo mandamos a la raíz donde estara el mensaje de bienvenida.
		    return Redirect::to('/');
		}
		
		return View::make('sesion.formLogueo');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Obtenemos el email, borramos los espacios
		// y convertimos todo a minúscula
		$username = mb_strtolower(trim(Input::get('username')));
		// Obtenemos la contraseña enviada
		$password = Input::get('password');

		$input = Input::all();

		$attempt = Auth::attempt(array(
			'username' => $username, 
			'password' => $password
		));

		if ($attempt) return Redirect::intended('/');

		/*if ($attempt) return Redirect::intended('/')->with('error', 'Usuario o contraseña incorrectos.');*/

		/*return Redirect::back()->with('flash_message', 'Te has desconectado');*/

		return Redirect::back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		if(Auth::check()){
		   Auth::logout();
		}

		/*return Redirect::home()->with('mensaje_error', 'Tu sesión ha sido cerrada.');*/
		return Redirect::to('/login');
	}


}
