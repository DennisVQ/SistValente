<?php
use Illuminate\Support\Collection;

	
class UsuarioController extends BaseController {
	
	
	public function index()
	{
		return View::make('usuario.index');
	}
	
	public function storedProcedureCall() {
         return DB::statement('call sp_estado_clientes');
    }

	/*Devuelve una tabla con el detalle de deuda del usuario*/
	public function getDT_Clientes()
	{
	    /*return Datatable::collection(
	    Usuario::all(
	        array('id', 'nombre_completo')
	        )
	    )
	    ->showColumns('nombre_completo', 'id')
	    ->searchColumns('nombre_completo')
	    ->orderColumns('nombre_completo')
	    ->make();
		*/

	    /*Forma para utilizar con TableTools de DataTable
	    $registros = DB::select('call sp_estado_clientes');
	    return Datatable::collection(new Collection($registros))
	    ->showColumns('cliente', 'acciones', 'id', 'estado')
	    ->searchColumns('cliente')
	    ->orderColumns('cliente')
	    ->addColumn('acciones', function($model) 
			{
				return'<a href="' .URL::action('MovimientoController@movimientosUsuarioAdmin', array('id' => $model->id)).'"><button class="btn btn-sm btn-warning">movimientos</button></a>
		        <a href="' .URL::to("movimientosClienteAdmin/".$model->id).'"><button class="btn btn-sm btn-danger">perfil</button></a>';
		    })
	    ->make();
		*/
		$registros = DB::select('call sp_estado_clientes');
	    return Datatable::collection(new Collection($registros))
	    ->showColumns('cliente', 'acciones', 'id', 'estado')
	    ->searchColumns('cliente')
	    ->orderColumns('cliente')
	    ->addColumn('cliente', function($model)
			{
				return'<a class="cliente" href="#" onclick="usuarioEscogido(\''.$model->cliente.'\', '.$model->id.', \''.$model->estado.'\');">'.$model->cliente.'</a>';
		    })
	    ->addColumn('acciones', function($model)
			{
				return'<a href="' .URL::action('MovimientoController@showAll_Admin', array('cliente_id' => $model->id)).'" class="btn btn-md btn-info">movimientos</a>
		        <a href="' .URL::action('UsuarioController@show', array('cliente_id' => $model->id)).'" class="btn btn-md btn-warning">Perfil</a>';
		    })
	    ->make();
	}

	public function getDT_Usuarios()
	{
	   
		$registros = Usuario::all();
	    return Datatable::collection($registros)
	    ->showColumns('nombre_completo', 'acciones', 'id')
	    ->searchColumns('nombre_completo')
	    ->orderColumns('nombre_completo')
	    ->addColumn('acciones', function($model)
			{
				return
        		'
                <a href="' .URL::action("UsuarioController@show", array('id' => $model->id)).'"><button class="btn btn-md btn-info">DETALLE</button></a>
                <a href="' .URL::action("UsuarioController@edit", array('id' => $model->id)).'"><button class="btn btn-md btn-warning">EDITAR</button></a>
                <a href="' .URL::action("UsuarioController@destroy", array('id' => $model->id)).'"><button class="btn btn-md btn-danger">ELIMINAR</button></a>
                ';		        
		    })	    
	    ->make();
	}

	/*
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{	/*$combobox = array(0 => "[ Seleccione ... ]") + $users->lists('id', 'name');*/
		
		$user = new Usuario;
		$organizaciones = array('' => "Seleccione... ") + Organizacion::lists('nombre', 'id');
        $areas = array('' => "Seleccione... ") + Area::lists('nombre', 'id');

        return View::make("usuario.formUsuario", array("organizaciones" => $organizaciones, "areas" => $areas, 'user'  =>  $user ));
        
		/*$organizaciones = Organizacion::all()->lists('nombre', 'id');
		$combobox = array(0 => "Seleccione ... ") + $tipos;
		$selected = array();
		return View::make("usuario.form", compact('combobox', 'selected'));
		
		return View::make('');*/
	}
	
	/*
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
			$user = new Usuario();
			$user->tipo = Input::get('tipo');
			$user->sexo = Input::get('sexo');

			if (Input::get('selectTratamientoM')!=''){
				$user->tratamiento = Input::get('selectTratamientoM');
				if ($user->tratamiento=='Otro'){
					$user->tratamiento = Input::get('txtTratamiento');
				}
			}

			if (Input::get('selectTratamientoF')!=''){
				$user->tratamiento = Input::get('selectTratamientoF');
				if ($user->tratamiento=='Otro'){
					$user->tratamiento = Input::get('txtTratamiento');
				}
			}

			if(Input::get('first_name')!=''){
				$user->nombre_primero = Input::get('first_name');
			}

			if(Input::get('middle_name')!=''){
				$user->nombres_sgtes = Input::get('middle_name');
			}

			if(Input::get('paternal_surname')!=''){
				$user->apellido_pat = Input::get('paternal_surname');
			}

			if(Input::get('maternal_surname')!=''){
				$user->apellido_mat = Input::get('maternal_surname');
			}

			if(Input::get('nickname')!=''){
				$user->apodo = Input::get('nickname');
			}

			if(Input::get('full_name')!=''){
				$user->nombre_completo = Input::get('full_name');
			}

			if(Input::get('dni')!=''){
				$user->dni = Input::get('dni');
			}

			if(Input::get('date_of_birth')!=''){
				$user->fecha_nac = Input::get('date_of_birth');
			}

			if(Input::get('date_of_birth')!=''){
				$user->organizacion_id = Input::get('organizacion');
			}

			if(Input::get('organizacion')!=0){
				$user->organizacion_id = Input::get('organizacion');
			}

			if(Input::get('area')!=0){
				$user->area_id = Input::get('area');
			}			

			if (Input::get('selectLimiteCredito')!=''){
				$user->limite_credito = Input::get('selectLimiteCredito');
				if ($user->limite_credito=='Otro'){
					$user->limite_credito = Input::get('txtLimiteCredito');
				}
			}

			if (Input::get('selectTiempoCredito')!=''){
				$user->tiempo_credito = Input::get('selectTiempoCredito');
				if ($user->tiempo_credito=='Otro'){
					$user->tiempo_credito = Input::get('txtTiempoCredito');
				}
			}

			if(Input::get('position')!=''){
				$user->cargo = Input::get('position');
			}

			if(Input::get('salary')!=''){
				$user->salario = Input::get('salary');
			}

			if(Input::get('date_of_admission')!=''){
				$user->fecha_ingreso = Input::get('date_of_admission');
			}

			if(Input::get('address')!=''){
				$user->direccion = Input::get('address');
			}

			if(Input::get('telephone_number')!=''){
				$user->telefono = Input::get('telephone_number');
			}

			if(Input::get('cell_phone_1')!=''){
				$user->celular1 = Input::get('cell_phone_1');
			}

			if(Input::get('cell_phone_2')!=''){
				$user->celular2 = Input::get('cell_phone_2');
			}

			if(Input::get('email')!=''){
				$user->email = Input::get('email');
			}

			if(Input::get('username')!=''){
				$user->username = Input::get('username');
			}

			if(Input::get('password')!=''){
				$user->password = Hash::make(Input::get('password'));
			}

			if(Input::get('password_confirmation')!=''){
				$user->password_confirmation = Hash::make(Input::get('password_confirmation'));
			}

			$validator = Usuario::validate(array(
			   'nombre_primero' => Input::get('first_name'),
			   'nombres_sgtes' => Input::get('middle_name'),
			   'apellido_pat' => Input::get('paternal_surname'),
			   'apellido_mat' => Input::get('maternal_surname'),
			   'apodo' => Input::get('nickname'),
			   'nombre_completo' => Input::get('full_name'),
			   'dni' => Input::get('dni'),
			   'fecha_nac' => Input::get('date_of_birth'),
			   'cargo' => Input::get('position'),
			   'salario' => Input::get('salary'),
			   'fecha_ingreso' => Input::get('date_of_admission'),
			   'telefono' => Input::get('telephone_number'),
			   'celular1' => Input::get('cell_phone_1'),
			   'celular2' => Input::get('cell_phone_2'),
		       'email' => Input::get('email'),
		       'username' => Input::get('username'),
		       'password' => Input::get('password'),
		       'password_confirmation' => Input::get('password_confirmation')
		   ));

		   if($validator->fails()){
		      $errors = $validator->messages()->all();
		      $user->password = null;
		      return Redirect::to('usuarios/create')->withErrors($validator)->withInput();
		      /*return Redirect::to('usuarios/create')->with('user', $user)->with('errors', $errors);*/
		   }else{
		      $user->save();
		      return Redirect::to('usuarios/create')->with('notice', 'El usuario ha sido creado correctamente.');
		   }
	}
	
	
	public function isValid($data)
	{
	    $rules = array(
	        'email'     => 'required|email|unique:users',
	        'username' => 'required|min:4|max:40',
	        'password'  => 'required|min:8|confirmed',
	    );
	    
	    $validator = Validator::make($data, $rules);
	    
	    if ($validator->passes())
	    {
	        return true;
	    }
	    
	    $this->errors = $validator->errors();
	    
	    return false;
	}
	
	
	
	/*
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$usuario = Usuario::find($id);
		return View::make('usuario.profile')->with('usuario', $usuario) ;
		/*return Response::json($nom_real)*/
	}
	
	public function show_Usuario_Auth()
	{
		$usuario = Auth::user();
		return View::make('usuario.profile')->with('usuario', $usuario) ;
		/*return Response::json($nom_real)*/
	}
	/*
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}
	
	
	/*
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}
	
	
	/*
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	
	
}
