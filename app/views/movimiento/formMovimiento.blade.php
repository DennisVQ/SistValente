@extends ('index')


@section ('title') Registrar Movimiento @stop

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

{{ Form::open(array('route' => 'movimientos.store', 'method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal')) }}

</br>
<button class="btn btn-lg btn-primary btn-block" type="submit">Registrar Movimiento</button>

<ul class="nav nav-tabs" role="tablist" id="tab1">
  <li class="active"><a href="#usuario" role="tab" data-toggle="tab">Escoger Usuario</a></li>
  <li><a href="#monto" role="tab" data-toggle="tab">Ingresar Monto</a></li>
</ul>

    <div class="tab-content">

    <div class="tab-pane active" id="usuario"> 

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

    {{-- sDom <!--http://www.datatables.net/release-datatables/examples/basic_init/dom.html-->--}}
    {{-- <!-- El aButtons vacio hace que no se muestre ningun boton predefinido de Tabletools-->--}}
    {{ Datatable::table()
    ->addColumn('cliente', 'acciones')
    ->setUrl(route('dtClientes'))
    ->setOptions(
    	array(
        'scrollY'=> 350,
        'scrollCollapse'=> true,
        'pageLength'=> '100000',
        'deferRender' => true,
        /*'iDisplayLength'=> '10000',        
        'lengthMenu' => [[-1], ["All"]],
        'paging'=> 'false',*/
        'sDom'          => '<"top"f>rt<"bottom"><"clear">T',
        'language'      =>  array(
            "emptyTable"=>     "No hay datos disponibles en la tabla",
            "info"=>           "Mostrando de _START_ a _END_ de _TOTAL_ Registros",
            "infoEmpty"=>      "Mostrando de 0 to 0 of 0 Registros",
            "infoFiltered"=>   "(filtrado de _MAX_ Registros Totales)",
            "infoPostFix"=>    "",
            "thousands"=>      ",",
            "lengthMenu"=>     "Mostrar _MENU_ Registros",
            "loadingRecords"=> "Cargando...",
            "processing"=>     "Procesando...",
            "search"=>        "Buscar Cliente:",
            "zeroRecords"=>   "No se encontro ningun registro",
            "paginate"=> array(
                "first"=>      "Inicio",
                "last"=>      "Final",
                "next"=>       "Sgte",
                "previous"=>   "Previo"
            )
        ),
        'oTableTools'   => array
        (
            "sRowSelect" => "single",
            "aButtons" =>  []
        )
    	)
    )
    ->setCallbacks(
        'createdRow', 'function (node, data) {
            if (data[3] == "Rojo" ) {
              $(node).removeClass("correcto prevencion");
              $(node).addClass("peligro");
            }else if(data[3] == "Verde"){
              $(node).removeClass("prevencion peligro");
              $(node).addClass("correcto");              
            }else{
              $(node).removeClass("correcto peligro");              
              $(node).addClass("prevencion");
            }
        }'
      )
    ->render() }}

    <script type="text/javascript">  
    $(window).load(function() {
        /*
        function fn(){
          var table = $('#dtdefault').dataTable();
          console.log(table.fnGetData().length);
        }
        */
        /* Este codigo es remplazado por la funcion usuarioEscogido que
        se ejecuta a traves del onclick configurado en el UsuarioController en getDataTable

        var oTT = TableTools.fnGetInstance( 'dtdefault' );
        
        $('#dtdefault tbody').on( 'click', 'tr', function () {
            var aData = oTT.fnGetSelectedData();
            if(aData.length > 0){
              $("#radioCredito").prop("checked", true);
              $("#inputCliente").val(aData[0][0]);
              $("#hiddenCliente").val(aData[0][2]);
              if(aData[0][3]=="Rojo"){
                $("#inputCliente").removeClass( "prevencion correcto" );
                $("#inputCliente").addClass( "peligro" );
              }else if(aData[0][3]=="Amarillo"){
                $("#inputCliente").removeClass( "peligro correcto" );
                $("#inputCliente").addClass( "prevencion" );
              }else{
                $("#inputCliente").removeClass( "prevencion peligro" );
                $("#inputCliente").addClass( "correcto" );
              };
              mostrarTab('1');// Selecciona 2do tab (0-empieza indiec)
              $("#inputMonto").focus();
              /*$("#divorContainer [name='yourInput']").focus();*/ //Opcion de Focus dentro de contenedor
            /*}


            else{
              console.log (aData.length);
              $("#inputCliente").val('');
              $("#hiddenCliente").val('');
            }
        });
        */
        $('#radioCredito').click(function () {
            $('#labelMonto').text('Monto de Credito (S/.)');
        });

        $('#radioPago').click(function () {
            $('#labelMonto').text('Monto de Pago (S/.)');
        });
    });
    


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
            /*$("#divorContainer [name='yourInput']").focus();*/ //Opcion de Focus dentro de contenedor
    }

    function mostrarTab(nro){
        $('#tab1 li:eq('+nro+') a').tab('show');
    }
    </script>

    </div> <!--Fin de Escoger Usuario-->

    <div class="tab-pane" id="monto"> 

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


    </div> <!--Fin de Monto-->

    <div class="tab-pane" id="detalle"> 
    </div> <!--Fin de Detalle-->

    </div> <!--Fin del Content-->    
    <button class="btn btn-lg btn-primary btn-block" type="submit">Registrar Movimiento</button>
    {{ Form::close() }}
@stop