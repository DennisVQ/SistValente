@extends ('index')


@section ('title') Registrar Usuario @stop

@section ('cabecera')


{{ HTML::script('assets/js/moment-with-locales.js') }}

{{ HTML::style('assets/css/bootstrap-datetimepicker.css') }}

{{ HTML::script('assets/js/bootstrap-datetimepicker.js') }}


<script type="text/javascript">

  $(document).ready(function () {

    cambiarSelectTratamiento($("input[name=sexo]").val());

    $("input[name=sexo]").click(function () { 
      cambiarSelectTratamiento($(this).val());
    });
  });



  function cambiarSelectTratamiento(sexo) {
    if(sexo=="masculino"){
      $('#selectTratamientoF').hide();
      $('#selectTratamientoF').val('');
      $('#selectTratamientoM').show();
    }
    else{
      $('#selectTratamientoM').hide();
      $('#selectTratamientoM').val('');
      $('#selectTratamientoF').show();
    }
  }
  /*
  function cambiarSelectTrat(sexo) {

      //var selectedOption = 'Ninguno';

      var select = $('#selectTratamiento');
      var options = document.getElementById('selectTratamiento');
      
      $('option', select).remove();
      //Eliminamos todas las opciones menos la que tenga el value "noborrar"
      //$('#lstCities option[value!="noborrar"]').remove();
      if (sexo=='masculino') {
          var optionsMasculino = {
              '' : 'Ninguno',
              'Sr.' : 'Sr.',
              'Dr.' : 'Dr.',
              'Lic.' : 'Lic.',
              'Joven' : 'Joven',
              'Otro' : 'Otro'
          };

          for(var index in optionsMasculino) {
              options[options.length] = new Option(optionsMasculino[index], index);
          }
      }else{
          var optionsFemenino = {
          '' : 'Ninguno',
          'Sra.' : 'Sra.',
          'Dra.' : 'Dra.',
          'Lic.' : 'Lic.',
          'Srta.' : 'Srta.',
          'Otro' : 'Otro'
          };

          for(var index in optionsFemenino) {
              options[options.length] = new Option(optionsFemenino[index], index);
          }
      }
      select.val('');
  }
  */
</script>

<script type="text/javascript">
  $(function () {
      $('#datetimepickerNacimiento, #datetimepickerIngreso').datetimepicker({
          language: 'es',
          pickTime: false
      });
  });


  //Habilitacion de Otro Tratamiento
  $(function(){

    $('select[name="selectTratamientoM"]').change(function(){
      if($(this).val()==="Otro")
        $('input[name="txtTratamiento"]').show();
      else{
         $('input[name="txtTratamiento"]').val('');
         $('input[name="txtTratamiento"]').hide();
      }
    }).change();

    $('select[name="selectTratamientoF"]').change(function(){
      if($(this).val()==="Otro")
        $('input[name="txtTratamiento"]').show();
      else{
         $('input[name="txtTratamiento"]').val('');
         $('input[name="txtTratamiento"]').hide();
      }
    }).change();

    $('select[name="selectLimiteCredito"]').change(function(){
    if($(this).val()==="Otro")
        $('input[name="txtLimiteCredito"]').show();
        else
            $('input[name="txtLimiteCredito"]').hide();
    }).change();

    $('select[name="selectTiempoCredito"]').change(function(){
    if($(this).val()==="Otro")
        $('input[name="txtTiempoCredito"]').show();
        else
            $('input[name="txtTiempoCredito"]').hide();
    }).change();

    //Autocopletado de FullName
    var tratamientoM = 'select[name=selectTratamientoM]';
    var tratamientoF = 'select[name=selectTratamientoF]';

    var first_name = 'input[name=first_name]';
    var middle_name = 'input[name=middle_name]';
    var paternal_surname = 'input[name=paternal_surname]';
    var maternal_surname = 'input[name=maternal_surname]';
    var nickname = 'input[name=nickname]';
    var full_name = '';


    $(tratamientoM +', ' + tratamientoF +', ' + first_name +', ' + middle_name +', ' + paternal_surname +', ' + maternal_surname +', ' + nickname).change(function(){

      if ($(first_name).val() != "" || $(paternal_surname).val() != ""){
        full_name = $(first_name).val() + " " + $(paternal_surname).val();
        añadirTratamiento();
      }
      else if ($(nickname).val() != ""){
        full_name = $(nickname).val();
        añadirTratamiento();
      }
      else if ($(middle_name).val() != "" || $(maternal_surname).val() != ""){
        full_name = $(middle_name).val() + " " + $(maternal_surname).val();
        añadirTratamiento();
      }
      else{
        full_name = "";
      }

      $('input[name=full_name]').val($.trim(full_name));

    }).change();

    function añadirTratamiento(){
      if($(tratamientoM).val()!=""){
        full_name += " (" + $(tratamientoM).val() + ")";
      }

      if($(tratamientoF).val()!=""){
        full_name += " (" + $(tratamientoF).val() + ")";
      }
    }



  }); 
</script>

@stop

@section ('contenido')

{{ Form::open(array('route' => 'usuarios.store', 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal')) }}

  </br>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Crear Usuario</button>

  @if ($errors->any())
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Por favor corrige los siguentes errores:</strong>
      <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif

  @if(Session::has('notice'))
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
         <p> <strong> {{ Session::get('notice') }} </strong> </p>
    </div>
  @endif

  <ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#tabPrincipal" role="tab" data-toggle="tab">Datos Principales</a></li>
    <li><a href="#tabLaboral" role="tab" data-toggle="tab">Datos Laborales</a></li>
    <li><a href="#tabPersonal" role="tab" data-toggle="tab">Datos de Personales</a></li>
    <li><a href="#tabLogueo" role="tab" data-toggle="tab">Datos de Logueo</a></li>
  </ul>

  <div class="tab-content">

  <div class="tab-pane active" id="tabPrincipal"> 

  <div class="form-group">
        {{ Form::label('tipo','Tipo de Usuario', array('class' => 'control-label col-sm-3')) }}
        <div class="col-sm-1">
            <label class="radio-inline">
      {{ Form::radio('tipo','cliente', true) }} Cliente
            </label>
        </div>
        <div class="col-sm-2">
            <label class="radio-inline">
      {{ Form::radio('tipo','trabajador') }} Trabajador
            </label>
        </div>
  </div>

  <div class="form-group">
      {{ Form::label('sexo','Sexo', array('class' => 'control-label col-sm-3')) }}
        <div class="col-sm-1">
            <label class="radio-inline">
      {{ Form::radio('sexo','masculino', true, array('id'=>'radioMasculino')) }} Masculino
            </label>
        </div>
        <div class="col-sm-2">
            <label class="radio-inline">
      {{ Form::radio('sexo','femenino', false, array('id'=>'radioFemenino')) }} Femenino
            </label>
        </div>
  </div>

  <div class="form-group">
      {{ Form::label('tratamiento', 'Tratamiento', array('class' => 'control-label col-sm-3')) }}
        <div class="col-sm-3">
          {{ Form::select('selectTratamientoM', array('' => 'Ninguno', 'Sr.' => 'Sr.', 'Dr.' => 'Dr.',
              'Lic.' => 'Lic.', 'Joven' => 'Joven', 'Otro' => 'Otro'), null, array('id'=>'selectTratamientoM', 'class' => 'form-control')) }}
          {{ Form::select('selectTratamientoF', array('' => 'Ninguno', 'Sra.' => 'Sra.', 'Dra.' => 'Dra.','Lic.' => 'Lic.',
              'Srta.' => 'Srta.', 'Otro' => 'Otro'), null, array('id'=>'selectTratamientoF', 'class' => 'form-control')) }}
        </div>
        <div class="col-sm-6">
          {{ Form::text('txtTratamiento', null, array('placeholder' => 'Tratamiento', 'class' => 'form-control')) }}   
        </div>
  </div>

  <div class="form-group @if ($errors->has('nombre_primero' ) || $errors->has('nombres_sgtes')
   || $errors->has('apellido_pat') || $errors->has('apellido_mat')) has-error @endif">
      {{ Form::label('full_name_detail', 'Nombre Completo', array('class' => 'control-label col-sm-3')) }}
      <div class="col-sm-2">
      {{ Form::text('first_name', Input::old('nombre_primero'), array('placeholder' => 'Primer Nombre', 'class' => 'form-control')) }}

      @if ($errors->has('nombre_primero')) <p class="help-block">{{ $errors->first('nombre_primero') }}</p> @endif

      </div>
      <div class="col-sm-2">
      {{ Form::text('middle_name', null, array('placeholder' => 'Nombres Sgtes', 'class' => 'form-control')) }} 

      @if ($errors->has('nombres_sgtes')) <p class="help-block">{{ $errors->first('nombres_sgtes') }}</p> @endif

      </div>
      <div class="col-sm-3">
      {{ Form::text('paternal_surname', null, array('placeholder' => 'Apellido Paterno', 'class' => 'form-control')) }} 

      @if ($errors->has('apellido_pat')) <p class="help-block">{{ $errors->first('apellido_pat') }}</p> @endif

      </div>
      <div class="col-sm-2">
      {{ Form::text('maternal_surname', null, array('placeholder' => 'Apellido Materno', 'class' => 'form-control')) }} 

      @if ($errors->has('apellido_mat')) <p class="help-block">{{ $errors->first('apellido_mat') }}</p> @endif

      </div>
  </div>

  <div class="form-group @if ($errors->has('apodo')) has-error @endif">
    {{ Form::label('nickname', 'Apodo', array('class' => 'control-label col-sm-3')) }}
    <div class="col-sm-9">
    {{ Form::text('nickname', null, array('placeholder' => 'Apodo', 'class' => 'form-control')) }}
    
    @if ($errors->has('apodo')) <p class="help-block">{{ $errors->first('apodo') }}</p> @endif
    
    </div>
  </div>

  <div class="form-group @if ($errors->has('nombre_completo')) has-error @endif">
    {{ Form::label('full_name', 'Nombre a Mostrar', array('class' => 'control-label col-sm-3')) }}
    <div class="col-sm-9">
    {{ Form::text('full_name', null, array('placeholder' => 'Nombre a Mostrar (Autocompletado)', 'class' => 'form-control')) }}        
    
    @if ($errors->has('nombre_completo')) <p class="help-block">{{ $errors->first('nombre_completo') }}</p> @endif

    </div>
  </div>

  <div class="form-group">
      {{ Form::label('credit_limit', 'Limite de Credito', array('class' => 'control-label col-sm-3')) }}
        <div class="col-sm-3">
          {{ Form::select('selectLimiteCredito', 
          array('0' => 'S/.0', '5' => 'S/.5', '10' => 'S/.10', '20' => 'S/.20', '50' => 'S/.50', '100' => 'S/.100', '200' => 'S/.200', 'Otro' => 'Otro'),
          null, array('id'=>'selectLimiteCredito', 'class' => 'form-control')) }}
        </div>
        <div class="col-sm-6">
          {{ Form::input('number', 'txtLimiteCredito', null, array('placeholder' => 'Limite de Credito (S/.)', 'class' => 'form-control')) }}
        </div>
  </div>  

  <div class="form-group">
    {{ Form::label('credit_time', 'Tiempo de Credito', array('class' => 'control-label col-sm-3')) }}
    <div class="col-sm-3">
      {{ Form::select('selectTiempoCredito', 
      array('0' => '0 Dias', '1' => 'Dia Siguiente', '7' => '1 Semana',  '14' => '2 Semanas', '30' => '1 Mes', '60' => '2 Meses', 'Otro' => 'Otro'),
      null, array('id'=>'selectTiempoCredito', 'class' => 'form-control')) }}
    </div>
    <div class="col-sm-6">
      {{ Form::input('number', 'txtTiempoCredito', null, array('placeholder' => 'Tiempo de Credito (Nro de Dias)', 'class' => 'form-control')) }}   
    </div>
  </div>

  </div> <!-- Aqui termina la seccion de Datos Principales-->

  <div class="tab-pane" id="tabLaboral"> 

  <div class="form-group">
      {{ Form::label('organizacion', 'Organizacion', array('class' => 'control-label col-sm-3')) }}
        <div class="col-sm-9">
          {{ Form::select('organizacion', $organizaciones, null, array('class' => 'form-control')) }}
        </div>
  </div>

  <div class="form-group">
      {{ Form::label('area', 'Area', array('class' => 'control-label col-sm-3')) }}
      <div class="col-sm-9">
        {{ Form::select('area', $areas, null, array('class' => 'form-control')) }}
      </div>
  </div>

  <div class="form-group @if ($errors->has('cargo')) has-error @endif">
    {{ Form::label('position', 'Cargo', array('class' => 'control-label col-sm-3')) }}
    <div class="col-sm-9">
    {{ Form::text('position', null, array('placeholder' => 'Cargo', 'class' => 'form-control')) }}

    @if ($errors->has('cargo')) <p class="help-block">{{ $errors->first('cargo') }}</p> @endif

    </div>
  </div>

  <div class="form-group @if ($errors->has('salario')) has-error @endif">
    {{ Form::label('salary', 'Salario (S/.)', array('class' => 'control-label col-sm-3')) }}
    <div class="col-sm-9">
    {{ Form::input('number', 'salary', null, array('placeholder' => 'Salario', 'class' => 'form-control')) }}

    @if ($errors->has('salario')) <p class="help-block">{{ $errors->first('salario') }}</p> @endif

    </div>
  </div>

  <div class="form-group @if ($errors->has('fecha_ingreso')) has-error @endif">
    {{ Form::label('date_of_admission', 'F. Ingreso', array('class' => 'control-label col-sm-3')) }}
    <div class="col-sm-9">
          <input type='date' name='date_of_admission' class="form-control" placeholder="DD/MM/YYYY" data-date-format="DD/MM/YYYY"/>

          @if ($errors->has('fecha_ingreso')) <p class="help-block">{{ $errors->first('fecha_ingreso') }}</p> @endif

      <!--<div class='input-group date' id='datetimepickerIngreso'>
          <input type='date' name='date_of_admission' class="form-control" placeholder="DD/MM/YYYY" data-date-format="DD/MM/YYYY"/>
          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
      </div>-->
    </div>
  </div>

  </div> <!-- Aqui termina la seccion de Datos Laborales-->

  <div class="tab-pane" id="tabPersonal">

  <div class="form-group">
    {{ Form::label('address', 'Direccion', array('class' => 'control-label col-sm-3')) }}
    <div class="col-sm-9">
    {{ Form::text('address', null, array('placeholder' => 'Direccion', 'class' => 'form-control')) }}
    </div>
  </div>

  <div class="form-group @if ($errors->has('telefono')) has-error @endif">
    {{ Form::label('telephone_number', 'Telefono', array('class' => 'control-label col-sm-3')) }}
    <div class="col-sm-9">
    {{ Form::input('tel', 'telephone_number', null, array('placeholder' => 'Telefono', 'class' => 'form-control')) }}

    @if ($errors->has('telefono')) <p class="help-block">{{ $errors->first('telefono') }}</p> @endif

    </div>
  </div>

  <div class="form-group @if ($errors->has('celular1')) has-error @endif">
    {{ Form::label('cell_phone_1', 'Celular 01', array('class' => 'control-label col-sm-3')) }}
    <div class="col-sm-9">
    {{ Form::input('tel', 'cell_phone_1', null, array('placeholder' => 'Celular 01', 'class' => 'form-control')) }}

    @if ($errors->has('celular1')) <p class="help-block">{{ $errors->first('celular1') }}</p> @endif

    </div>
  </div>

  <div class="form-group @if ($errors->has('celular2')) has-error @endif">
    {{ Form::label('cell_phone_2', 'Celular 02', array('class' => 'control-label col-sm-3')) }}
    <div class="col-sm-9">
    {{ Form::input('tel', 'cell_phone_2', null, array('placeholder' => 'Celular 02', 'class' => 'form-control')) }}

    @if ($errors->has('celular2')) <p class="help-block">{{ $errors->first('celular2') }}</p> @endif

    </div>
  </div>

  <div class="form-group @if ($errors->has('dni')) has-error @endif">
    {{ Form::label('dni', 'DNI', array('class' => 'control-label col-sm-3')) }}
    <div class="col-sm-9">
    {{ Form::input('number', 'dni', null, array('placeholder' => 'DNI', 'class' => 'form-control')) }}

    @if ($errors->has('dni')) <p class="help-block">{{ $errors->first('dni') }}</p> @endif

    </div>
  </div>

  <div class="form-group @if ($errors->has('fecha_nac')) has-error @endif">
    {{ Form::label('date_of_birth', 'F. Nacimiento', array('class' => 'control-label col-sm-3')) }}
    <div class="col-sm-9">
          <input type='date' name='date_of_birth' class="form-control" placeholder="DD/MM/YYYY" data-date-format="DD/MM/YYYY"/>

          @if ($errors->has('fecha_nac')) <p class="help-block">{{ $errors->first('fecha_nac') }}</p> @endif

      <!--<div class='input-group date' id='datetimepickerNacimiento'>
          <input type='date' name='date_of_birth' class="form-control" placeholder="DD/MM/YYYY" data-date-format="DD/MM/YYYY"/>
          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
      </div>-->
    </div>
  </div>

  </div> <!-- Aqui termina la seccion de Datos Personales-->
  
  <div class="tab-pane" id="tabLogueo">

  <div class="form-group @if ($errors->has('email')) has-error @endif">
    {{ Form::label('email', 'Email', array('class' => 'control-label col-sm-3')) }}
    <div class="col-sm-9">
    {{ Form::email('email', null, array('placeholder' => 'Email', 'class' => 'form-control')) }}

    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif

    </div>
  </div>

  <div class="form-group @if ($errors->has('username')) has-error @endif">
    {{ Form::label('username', 'Nombre de Usuario', array('class' => 'control-label col-sm-3')) }}
    <div class="col-sm-9">
    {{ Form::text('username', '', array('placeholder' => 'Nombre de Usuario', 'class' => 'form-control')) }}

    @if ($errors->has('username')) <p class="help-block">{{ $errors->first('username') }}</p> @endif

    </div>
  </div>

  <div class="form-group @if ($errors->has('password')) has-error @endif">
    {{ Form::label('password', 'Contraseña', array('class' => 'control-label col-sm-3')) }}
    <div class="col-sm-9">
    {{ Form::password('password', array('placeholder' => 'Contraseña', 'class' => 'form-control')) }} 

    @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif

    </div>
  </div>

  <div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
    {{ Form::label('password_confirmation', 'Confirmar Contraseña', array('class' => 'control-label col-sm-3')) }}
    <div class="col-sm-9">
    {{ Form::password('password_confirmation', array('placeholder' => 'Confirmar Contraseña', 'class' => 'form-control')) }}

    @if ($errors->has('password_confirmation')) <p class="help-block">{{ $errors->first('password_confirmation') }}</p> @endif

    </div>
  </div>

  </div> <!-- Aqui termina la seccion de Datos de Logueo-->
  </div> <!-- Aqui termina Tab Content-->

  <button class="btn btn-lg btn-primary btn-block" type="submit">Crear Usuario</button>

{{ Form::close() }}
@stop