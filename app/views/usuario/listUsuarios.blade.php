@extends ('index')


@section ('title') Lista de Usuarios @stop

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

</br>
</br>

    {{ Datatable::table()
    ->addColumn('cliente', 'acciones')
    ->setUrl(route('dtUsuarios'))
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
            "search"=>        "Buscar Usuario:",
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
    ->render() 
  }}
@stop