@extends ('index')


@section ('title') Editar Movimiento @stop

@section ('cabecera')
    {{ HTML::style('assets/css/dataTables.responsive.css') }}
    {{ HTML::style('assets/css/jquery.dataTables.css') }}
    {{ HTML::style('assets/css/dataTables.tableTools.css') }}

    {{ HTML::script('assets/js/jquery.dataTables.min.js') }}
    {{ HTML::script('assets/js/dataTables.responsive.js') }}
    {{ HTML::script('assets/js/dataTables.tableTools.js') }}


    <style type="text/css">
    .dataTables_wrapper .dataTables_filter {
       float: left;
       text-align: left;
    }
    </style>

@stop

@section ('contenido')

{{ Form::open(array('route' => 'movimientos.update', 'method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal')) }}

</br>
<button class="btn btn-lg btn-primary btn-block" type="submit">Actualizar Movimiento</button>
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

    <script type="text/javascript">  
    $(window).load(function() {
        $('#radioCredito').click(function () {
            $('#labelMonto').text('Monto de Credito (S/.)');
        });

        $('#radioPago').click(function () {
            $('#labelMonto').text('Monto de Pago (S/.)');
        });
    });
    
    /*
    function usuarioEscogido(nombre, id, estado){
            $("#radioCredito").prop("checked", true);
            $("#inputCliente").val(nombre);
            $("#hiddenCliente").val(id);
            if(estado=="Rojo"){
              $("#inputCliente").removeClass( "prevencion correcto" );
              $("#inputCliente").addClass( "peligro" );
            }else if(estado=="Amarillo"){
              $("#inputCliente").removeClass( "peligro correcto" );
              $("#inputCliente").addClass( "prevencion" );
            }else{
              $("#inputCliente").removeClass( "prevencion peligro" );
              $("#inputCliente").addClass( "correcto" );
            };
            mostrarTab('1');// Selecciona 2do tab (0-empieza indiec)
            $("#inputMonto").focus();
            //$("#divorContainer [name='yourInput']").focus(); //Opcion de Focus dentro de contenedor
    }
    */
    </script>

        <div class="form-group">
          {{ Form::label('cliente', 'Cliente Seleccionado ', array('class' => 'control-label col-sm-3')) }}
          <div class="col-sm-9">
          {{ Form::hidden('cliente_id', '', array('id' => 'hiddenCliente')) }}
          {{ Form::input('text', 'cliente_name', '...', array('id' => 'inputCliente', 'class' => 'form-control', 'readonly'=>'readonly', 'onclick'=>'mostrarTab(0)')) }}
          </div>
        </div>

        <div class="form-group">
          {{ Form::label('tipoMov','Tipo de Movimiento', array('class' => 'control-label col-sm-3')) }}
            <div class="col-sm-1">
                <label class="radio-inline">
          {{ Form::radio('tipoMov','credito', true, array('id'=>'radioCredito')) }} Credito
                </label>
            </div>
            <div class="col-sm-2">
                <label class="radio-inline">
          {{ Form::radio('tipoMov','pago', false, array('id'=>'radioPago')) }} Pago
                </label>
            </div>
        </div>

        <div class="form-group">
          {{ Form::label('monto', 'Monto de Credito (S/.)', array('id'=>'labelMonto', 'class' => 'control-label col-sm-3')) }}

          <div class="col-sm-9">
            {{ Form::input('number', 'monto', null, array('id'=>'inputMonto', 'class' => 'form-control', 'placeholder' => 'Monto ', 'autofocus', 'required', 'min'=>'0.10', 'max'=>'9999', 'step'=>'0.01')) }}

            {{--<div class="input-group">
               <span class="input-group-addon">S/.</span>
               Form::input('number', 'monto', null, array('id'=>'monto1', 'class' => 'form-control', 'placeholder' => 'Monto ', 'autofocus', 'required' ))
            </div>--}}

          </div>

        </div>

        <div class="form-group">
          {{ Form::label('nota', 'Nota', array('class' => 'control-label col-sm-3')) }}
          <div class="col-sm-9">
          {{ Form::text('nota', null, array('placeholder' => 'Nota', 'class' => 'form-control')) }}        
          </div>
        </div>


    <button class="btn btn-lg btn-primary btn-block" type="submit">Actualizar Movimiento</button>
    {{ Form::close() }}
@stop