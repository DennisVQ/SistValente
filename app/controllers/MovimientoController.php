<?php

class MovimientoController extends BaseController {


	public function prueba(){
		/*'
	    <a href="' .URL::action('MovimientoController@show', array('id' => $model->$id)).'"><button class="btn btn-sm btn-warning">detalle</button></a>
	    <a href="' .URL::action('MovimientoController@edit', array('id' => $model->$id)).'"><button class="btn btn-sm btn-warning">editar</button></a>
	    <a href="' .URL::action('MovimientoController@destroy', array('id' => $model->$id)).'"><button class="btn btn-sm btn-danger">eliminar</button></a>
	    ';*/
		return View::make('movimiento.listMovimientos');
	}

	public function showAll_Admin($cliente_id){
		return View::make('movimiento.listMovimientos', array('cliente_id' => $cliente_id));
	}

	public function showAll_Cliente(){
		return View::make('movimiento.listMovimientos');
	}

	public function getDT_Admin($cliente_id)
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
        return Datatable::collection(Movimiento::where('cliente_id', '=', $cliente_id)->get())
	    ->showColumns('fecha', 'monto', 'acciones', 'id', 'tipo')
	    ->searchColumns('fecha')
	    ->orderColumns('fecha', 'monto')
		/*https://github.com/jenssegers/laravel-date*/
	    ->addColumn('fecha', function($model){
		    	Lang :: setLocale ('es');
		    	$fecha = Date::parse($model->created_at);
		    	return $fecha->diffForHumans().' - '.$fecha->format('d/m');
	    	})
	    ->addColumn('acciones', function($model)
			{
				/*
				'
		        <a href="' .URL::to("movimientos/".$model->id).'"><button class="btn btn-sm btn-warning">detalle</button></a>
		        <a href="' .URL::to("movimientos/".$model->id."/edit").'"><button class="btn btn-sm btn-warning">editar</button></a>
		        <a href="' .URL::to("movimientos/destroy/".$model->id).'"><button class="btn btn-sm btn-danger">eliminar</button></a>
		        ';
		        */
				return
        		'
                <a href="' .URL::action("MovimientoController@show", array('id' => $model->id)).'"><button class="btn btn-md btn-info">DETALLE</button></a>
                <a href="' .URL::action("MovimientoController@edit", array('id' => $model->id)).'"><button class="btn btn-md btn-warning">EDITAR</button></a>
                <a href="' .URL::action("MovimientoController@destroy", array('id' => $model->id)).'"><button class="btn btn-md btn-danger">ELIMINAR</button></a>
                ';		        
		    })
	    ->make();
	}

	public function getDT_Cliente($cliente_id)
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
        return Datatable::collection(Movimiento::where('cliente_id', '=', $cliente_id)->get())
	    ->showColumns('fecha', 'monto', 'acciones', 'id', 'tipo')
	    ->searchColumns('fecha')
	    ->orderColumns('fecha', 'monto')
		/*https://github.com/jenssegers/laravel-date*/
	    ->addColumn('fecha', function($model){
		    	Lang :: setLocale ('es');
		    	$fecha = Date::parse($model->created_at);
		    	return $fecha->diffForHumans().' - '.$fecha->format('d/m');
	    	})
	    ->addColumn('acciones', function($model)
			{
				/*
				'
		        <a href="' .URL::to("movimientos/".$model->id).'"><button class="btn btn-sm btn-warning">detalle</button></a>
		        <a href="' .URL::to("movimientos/".$model->id."/edit").'"><button class="btn btn-sm btn-warning">editar</button></a>
		        <a href="' .URL::to("movimientos/destroy/".$model->id).'"><button class="btn btn-sm btn-danger">eliminar</button></a>
		        ';
		        */
				return
        		'
                <a href="' .URL::action("MovimientoController@show", array('id' => $model->id)).'"><button class="btn btn-md btn-warning">DETALLE</button></a>
				';		        
		    })
	    ->make();
	}
	/*
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

	}


	/*
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('movimiento.formMovimiento');
	}


	/*
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
			$movimiento = new Movimiento();

			if (Input::get('cliente_id')!='...'){
				$movimiento->cliente_id = Input::get('cliente_id');
			}

			$movimiento->trabajador_id = Auth::user()->id;

			$movimiento->tipo = Input::get('tipoMov');

			if(Input::get('monto')!=''){
				if ($movimiento->tipo=='pago'){
					$movimiento->monto = Input::get('monto')*-1;
				}else{
					$movimiento->monto = Input::get('monto');
				}
			}

			if(Input::get('nota')!=''){
				$movimiento->nota = Input::get('nota');
			}

			$validator = Movimiento::validate(array(
			   'cliente_id' => Input::get('cliente_id'),
			   'trabajador_id' => Auth::user()->id,
			   'monto' => Input::get('monto')
		   ));

		   if($validator->fails()){
		      $errors = $validator->messages()->all();

		      return Redirect::to('movimientos/create')->withErrors($validator)->withInput();
		      /*return Redirect::to('usuarios/create')->with('user', $user)->with('errors', $errors);*/
		   }else{
		      $movimiento->save();
		      return Redirect::to('movimientos/create')->with('notice', 'El movimiento ha sido generado correctamente.');
		   }
	}


	/*
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$movimiento = Movimiento::find($id);
		return View::make("movimiento.showMovimiento")->with('movimiento', $movimiento);
	}
	/*
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
	   $movimiento = Movimiento::find($id);
	   $nombre_cliente = Usuario::find($movimiento->cliente_id);
	   //return View::make('movimiento.editMovimiento')->with('movimiento', $movimiento);
	   return View::make('movimiento.editMovimiento', array('movimiento' => $nombre_cliente, 'movimiento' => $nombre_cliente));	   
	}


	/*
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	   		$movimiento = Movimiento::find($id);

			$movimiento->trabajador_id = Auth::user()->id;

			$movimiento->tipo = Input::get('tipoMov');

			if(Input::get('monto')!=''){
				if ($movimiento->tipo=='pago'){
					$movimiento->monto = Input::get('monto')*-1;
				}else{
					$movimiento->monto = Input::get('monto');
				}
			}

			if(Input::get('nota')!=''){
				$movimiento->nota = Input::get('nota');
			}

			$validator = Movimiento::validate(array(
			   'cliente_id' => Input::get('cliente_id'),
			   'trabajador_id' => Auth::user()->id,
			   'monto' => Input::get('monto')
		   ));

		   if($validator->fails()){
		      $errors = $validator->messages()->all();

		      return Redirect::to('movimientos/edit')->withErrors($validator)->withInput();
		      /*return Redirect::to('usuarios/create')->with('user', $user)->with('errors', $errors);*/
		   }else{
		      $movimiento->save();
		      return Redirect::to('movimientos/edit')->with('notice', 'El movimiento ha sido editado correctamente.');
		   }
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
