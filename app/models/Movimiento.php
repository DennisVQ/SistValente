<?php
class Movimiento extends Eloquent
{
public $errors;

/********************Validacion de formulario*****************************/

public static $rules = array(
	'cliente_id' => 'required|numeric|exists:usuarios,id',
	'trabajador_id' => 'required|numeric|exists:usuarios,id',
	'monto' => 'numeric|min:0.1'
);

public static $messages = array(
	'cliente_id.required' => 'Escoger el cliente es obligatorio.',
	'cliente_id.numeric' => 'El id del cliente debe ser numerico.',
	'cliente_id.exists' => 'El cliente debe existir en la base de datos.',
	'trabajador_id.required' => 'El id del trabajador es obligatorio.',
	'trabajador_id.numeric' => 'El id del trabajador debe ser numerico.',
	'trabajador_id.exists' => 'El id del trabajador debe existir en la base de datos.',
	'monto.numeric' => 'El Monto debe ser numerico.',
	'monto.min' => 'El Monto debe ser mayor o igual a S/.0.10'	
);

public static function validate($data){
   $reglas = self::$rules;
   $messages = self::$messages;
   return Validator::make($data, $reglas, $messages);
}

/***********************************************************************/

  public function usuario_cliente(){
     return $this->belongsTo('Usuario','cliente_id', 'id' );
  }

  public function usuario_trabajador(){
     return $this->belongsTo('Usuario', 'trabajador_id', 'id');
  }
}
?>