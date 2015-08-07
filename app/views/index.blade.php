<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>@yield('title', 'Sistema de Cafeteria Valentes')</title>


    <!-- Bootstrap core CSS -->
    {{ HTML::style('assets/css/bootstrap.min.css') }}
    {{--<link href="assets/css/bootstrap.min.css" rel="stylesheet">--}}


    {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js') }}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>--}}


    <!-- Custom styles for this template -->
    {{ HTML::style('assets/css/estilo-sistema.css') }}
    {{--<link href="assets/css/estilo_principal.css" rel="stylesheet">--}}

    {{ HTML::script('assets/js/ie-emulation-modes-warning.js') }}
    {{--<script src="assets/js/ie-emulation-modes-warning.js"></script>--}}


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

@section('cabecera')
@show

  </head>

  <body>

    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">

        <div class="navbar-header">
          <!--Icono y Menu para Moviles-->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!--Marca
          <a class="navbar-brand" href="http://54.68.98.251/SistValente/public">
          {{-- HTML::image('assets\images\logo.png', 'Valente', array('class' => '')) --}}
          <p>{{ HTML::image('assets\images\logo.png', 'Valente', array('style' => 'vertical-align: middle;'))}}
          VALENTE</br>
          <span>Sistema</span></p>-->
          
          <a class="navbar-brand" href="http://54.68.98.251/SistValente/public">
          <!-- composición en vertical -->
          <div class="logo-image">{{ HTML::image('assets/images/logo.png', 'Logo Valente', array('width'=>'80px', 'height'=>'80px'))}}</div>
          <div class="logo-texto">S</br>I</br>S</br>T</br>E</br>M</br>A</div>
          <!--<div class="logo-texto">VALENTE</br><span>Sistema</span></div>-->
          </a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav cl-effect-13">
            <!--<li><a data-scroll="" href="http://54.68.98.251/">WEB</a></li>--!> <!-- ../../ para ir dos carpetas atras -->
          </ul>

          @if(!Auth::check())
            <div class="navbar-form pull-right">
              {{ HTML::link('login', 'Logueo', array('type'=>'button', 'class'=>'btn btn-primary')) }}
            </div>
          @else
              <ul class="nav navbar-nav cl-effect-13">
                @if(Auth::user()->tipo == 'Dueño' || Auth::user()->tipo == 'Administrador')
                <li><a data-scroll="" href="http://54.68.98.251/SistValente/public/movimientos/create">CREAR MOVIMIENTO</a></li>
                <li><a data-scroll="" href="http://54.68.98.251/SistValente/public/usuarios/create">CREAR USUARIO</a></li>
                @else
                <li><a data-scroll="" href="http://54.68.98.251/SistValente/public/mis/movimientos">MIS MOVIMIENTO</a></li>
                @endif
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li> <a href="{{URL::route('mi.perfil')}}"> <span class="glyphicon glyphicon-user"> </span> {{(Auth::user()->nombre_completo)}} </a></li>
                <div class="navbar-form pull-left">
                {{ HTML::link('logout', 'Salir', array('type'=>'button', 'class'=>'btn btn-success')) }}
                </div>
              </ul>
          @endif
        </div>


        </div><!--/.nav-collapse -->
      </div>
    </div>


@section('contenido')

<div class="container">
      </br>
      </br>
      </br>
      </br>
      </br>
      </br>
      </br>
      </br>
      </br>
      </br>
      <h1>BIENVENIDOS</h1>

@show

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    {{ HTML::script('assets/js/bootstrap.min.js') }}
    {{--<script src="assets/js/bootstrap.min.js"></script>--}}
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    {{ HTML::script('assets/js/ie10-viewport-bug-workaround.js') }}
    {{--<script src="assets/js/ie10-viewport-bug-workaround.js"></script>--}}
  </body>
</html>