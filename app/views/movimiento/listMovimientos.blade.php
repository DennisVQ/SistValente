@extends ('index')


@section ('title') Lista de Movimientos @stop

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
    <br>
    <a href="{{URL::previous()}}"><button class="btn btn-lg btn-primary btn-block" type="submit">Volver</button></a>

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
    {{
        $ruta = '';
        //Existe $cliente_id?
        if(isset($cliente_id)){
            $ruta = 'dtMovimientos.admin';
        }else{
            $cliente_id = Auth::User()->id;
            $ruta = 'dtMovimientos.cliente';            
        }
    }}

    <h3>Movimientos de "{{Usuario::find($cliente_id)->nombre_completo}}"</h3>
    {{ Datatable::table()
    ->addColumn('fecha', 'monto', 'acciones')
    ->setUrl(route($ruta, array($cliente_id)))
    ->setOptions(
        array(
        'scrollY'=> '350px',
        'scrollCollapse'=> 'true',
        'iDisplayLength'=> '10000',
        /*'lengthMenu' => [[-1], ["All"]],
        'bPaginate'=> 'true',
        'paging'=> 'true',*/
        'order' => [[ 0, "desc" ]],
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
                "search"=>        "Buscar Por Fecha:",
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
            if (data[4] == "credito" ) {
              $(node).removeClass("correcto");
              $(node).addClass("peligro");
            }else if(data[4] == "pago"){
              $(node).removeClass("peligro");
              $(node).addClass("correcto");
            }else{
              $(node).removeClass("correcto peligro");              
            }
        }'
      )
    ->render() }}


    <a href="{{URL::previous()}}"><button class="btn btn-lg btn-primary btn-block" type="submit">Volver</button></a>
@stop