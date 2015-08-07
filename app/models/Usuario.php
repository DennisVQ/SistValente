<?php

/***********Uses se copio de Usuario************/
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
/**********************************************/

/***********UserInterface, RemindableInterface se copio de Usuario************/

class Usuario extends Eloquent implements UserInterface, RemindableInterface { 

/*****************************************************************************/

	/***********Se copio de Usuario*************************************/
	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	/*Si NO se especificase el atributo $table = 'usuarios'. Laravel usaria por defecto 'El nombre de la clase en plural y minuscula' osea usuarios*/
	protected $table = 'usuarios';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	/*En ocasiones es necesario limitar los atributos que son incluidos en el Array del modelo o JSON, como contraseñas.
	 Para ello, añadir la propiedad hidden a la definición del modelo
	 */
	protected $hidden = array('password', 'remember_token');

	/*Al utilizar el metodo create esta haciendo 'Asignacion en Masa'. 
	Por seguridad se debe poner en el array $fillable los campos que pueden asignarse o insertarse de esa manera
	*/
	protected $fillable = array('username', 'password');

	public $errors;
	
	/*
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	/*****************************************************************/
	
	/********************Validacion de formulario*****************************/
	
	public static $rules = array(
		'nombre_primero' => 'alpha',
		'nombres_sgtes' => 'alpha',
		'apellido_pat' => 'alpha',
		'apellido_mat' => 'alpha',
		'apodo' => 'alpha',
		'nombre_completo' => 'required|unique:usuarios,nombre_completo|min:2',
		'dni' => 'numeric',
		'fecha_nac'  => 'date_format:Y/m/d',
		'cargo' => 'alpha',
		'salario' => 'numeric',
		'fecha_ingreso'  => 'date_format:Y/m/d',
		'telefono' => 'numeric',
		'celular1' => 'numeric',
		'celular2' => 'numeric',
		'email' => 'email|unique:usuarios,email',
		'username' => 'unique:usuarios,username',
		'password' => 'alpha_num|between:4,12|confirmed',
		'password_confirmation' => 'alpha_num|between:4,12'
	);
	
	public static $messages = array(
		'nombre_completo.required' => 'El nombre completo es obligatorio.',
		'nombre_completo.min' => 'El nombre completo debe contener minimo 2 letras.',
		'nombre_completo.unique' => 'El nombre completo debe contener solo letras.',
		'nombre_primero.alpha' => 'El primer nombre debe contener solo letras.',
		'nombres_sgtes.alpha' => 'El segundo nombre debe contener solo letras.',
		'apellido_pat.alpha' => 'El apellido paterno debe contener solo letras.',
		'apellido_mat.alpha' => 'El apellido materno debe contener solo letras.',
		'apodo.alpha' => 'El Apodo debe contener solo letras.',
		'dni.numeric' => 'El DNI debe ser numerico.',
		'fecha_nac.date_format' => 'La Fecha debe seguir el formato sgte: Dia/Mes/Año.',
		'cargo.alpha' => 'El Cargo debe contener solo letras.',
		'salario.numeric' => 'El Salario debe ser numerico.',
		'fecha_ingreso.date_format' => 'La Fecha debe seguir el formato sgte: Dia/Mes/Año.',
		'telefono.numeric' => 'El Telefono debe ser numerico.',
		'celular1.numeric' => 'El Celular 1 debe ser numerico.',
		'celular2.numeric' => 'El Celular 2 debe ser numerico.',
	    'email.email' => 'El email debe contener un formato válido.',
	    'email.unique' => 'El email pertenece a otro usuario.',
	    'username.unique' => 'El usuario pertenece a otro usuario.',
	    'password.alpha_num' => 'La contraseña debe contener solo letras y/o numeros.',
	    'password.between' => 'La contraseña solo puede tener entre 4 y 12 caracteres.',
	    'password.confirmed' => 'La contraseña no ha sido confirmada.',
	    'password_confirmation.alpha_num' => 'La contraseña debe contener solo letras y/o numeros.',
	    'password_confirmation.between' => 'La contraseña solo puede tener entre 4 y 12 caracteres.'
	);
	
	public static function validate($data){
		/* Self es como This pero utilizado para los miembros estaticos
			This es para Objeto Actual
			Self es para Clase Actual
		*/
	   $reglas = self::$rules;
	   $messages = self::$messages;
	   return Validator::make($data, $reglas, $messages);
	}

	/***********************************************************************/

	/***********Metodos de UserInterface*************************************/

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
	    return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
	    return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
	    return $this->email;
	}

	/*****************************************************************/

	/***************Metodos de RemindableInterface********************/

	public function getRememberToken() {
	        return $this->remember_token;
	    }

    public function setRememberToken($value) {
        $this->remember_token = $value;
    }

    public function getRememberTokenName() {
        return 'remember_token';
    }

	/*****************************************************************/

	public function organizacion(){
	   return $this->belongsTo('Organizacion');
	}

	public function area(){
	   return $this->belongsTo('Area');
	}

	public function area_jefe(){
	   return $this->hasOne('Area', 'jefe_id', 'id');
	}

	public function movimiento_cliente(){
	   return $this->hasMany('Movimiento','cliente_id', 'id');
	}

	public function movimiento_trabajador(){
	   return $this->hasMany('Movimiento','trabajador_id', 'id');
	}


	/*****************************************************************/
	/*Para Filtros de Tipo de Usuario*/

	public function isDueno()
	{
	    return $this->cargo === 'Dueño';
	}

	public function isAdministrador()
	{
		$cargo = $this->cargo;
		
		if ($cargo === 'Administrador' || $cargo === 'Dueño') {
	    	return true;			
		}

	    return false;

	}

	public function isVendedor()
	{
	    return $this->cargo === 'Vendedor';
	}

	public function isCliente()
	{
	    return $this->cargo === 'Cliente';
	}
}
?>