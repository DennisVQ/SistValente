@extends ('index')


@section ('title') Mi Perfil @stop

@section ('cabecera')

<script type="text/javascript">
$(document).ready(function() {
    var panels = $('.user-infos');
    var panelsButton = $('.dropdown-user');
    panels.hide();

    //Click dropdown
    panelsButton.click(function() {
        //get data-for attribute
        var dataFor = $(this).attr('data-for');
        var idFor = $(dataFor);

        //current button
        var currentButton = $(this);
        idFor.slideToggle(400, function() {
            //Completed slidetoggle
            if(idFor.is(':visible'))
            {
                currentButton.html('<i class="glyphicon glyphicon-chevron-up text-muted"></i>');
            }
            else
            {
                currentButton.html('<i class="glyphicon glyphicon-chevron-down text-muted"></i>');
            }
        })
    });


    $('[data-toggle="tooltip"]').tooltip();

    $('button').click(function(e) {
        e.preventDefault();
        alert("This is a demo.\n :-)");
    });
});
</script>

@section('contenido')
</br>
  <a href="{{URL::previous()}}"><button class="btn btn-lg btn-primary btn-block" type="submit">Volver</button></a>

<div class="container">

      <div class="row">
      <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
        {{--<A href="edit.html" >Edit Profile</A>

        <A href="edit.html" >Logout</A>
        <br>--}}
        <p class=" text-info">{{Lang::setLocale('es')}} {{Date::now()->format('l j F Y H:i:s')}}</p>
      </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">{{$usuario->nombre_completo}}</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle"> </div>
                
                <!--<div class="col-xs-10 col-sm-10 hidden-md hidden-lg"> <br>
                  <dl>
                    <dt>DEPARTMENT:</dt>
                    <dd>Administrator</dd>
                    <dt>HIRE DATE</dt>
                    <dd>11/12/2013</dd>
                    <dt>DATE OF BIRTH</dt>
                       <dd>11/12/2013</dd>
                    <dt>GENDER</dt>
                    <dd>Male</dd>
                  </dl>
                </div>-->
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>-Nombre- :</td>
                        <td>{{$usuario->nombre_primero}}</td>
                      </tr>
                      <tr>
                        <td>-Segundo Nombre- :</td>
                        <td>{{$usuario->nombres_sgtes}}</td>
                      </tr>
                      <tr>
                        <td>-Apellido Paterno- :</td>
                        <td>{{$usuario->apellido_pat}}</td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>-Apellido Materno- :</td>
                        <td>{{$usuario->apellido_mat}}</td>
                      </tr>
                        <tr>
                        <td>-Nick- :</td>
                        <td>{{$usuario->apodo}}</td>
                      </tr>
                      </tr>
                        <tr>
                        <td>-Sexo- :</td>
                        <td>{{$usuario->sexo}}</td>
                      </tr>
                      </tr>
                        <tr>
                        <td>-Fec. Nacimiento- :</td>
                        <td>{{$usuario->fecha_nac}}</td>
                      </tr>
                      </tr>
                      <tr>
                        <td>-Direccion- :</td>
                        <td>{{$usuario->direccion}}</td>
                      </tr>                      
                        <td>-Telefonos- :</td>
                        <td>{{$usuario->direccion}} (Fijo)<br><br>{{$usuario->celular1}} (Movil)<br><br>{{$usuario->celular2}} (Movil)
                        </td>
                      </tr>
                      <tr>
                       <td>-Email- :</td>
                       <td><a href="mailto:info@support.com">{{$usuario->email}}</a></td>
                      </tr>
                      <tr>
                        <td>-Organizacion- :</td>
                        <td><a href="#">{{Organizacion::find($usuario->organizacion_id)->nombre}}</td>
                      </tr>
                      {{-- mandaba una excepcion
                      <tr>
                        <td>-Area de Trabajo- :</td>
                        <td><a href="#">{{Area::find($usuario->area_id)->nombre}}</td>
                      </tr>
                      --}}
                      <tr>
                        <td>-Cargo- :</td>
                        <td>{{$usuario->cargo}}</td>
                      </tr>
                      <tr>
                        <td>-Fecha de Alta- :</td>
                        <td>{{$usuario->fecha_ingreso}}</td>
                      </tr>
                      <tr>
                        <td>-Nombre de Usuario- :</td>
                        <td>{{$usuario->username}}</td>
                      </tr>
                      <tr>
                        <td>-Limite de Credito- :</td>
                        <td>S/. {{$usuario->limite_credito}}</td>
                      </tr>
                      <tr>
                        <td>-Tiempo de Credito- :</td>
                        <td>{{$usuario->tiempo_credito}} Dias</td>
                      </tr> 
                      <tr>
                        <td>-Estado- :</td>
                        <td>{{$usuario->activo}}</td>
                      </tr>
                      <tr>
                        <td>-Fec. Ultima Modificacion- :</td>
                        <td>{{Date::parse($usuario->updated_at)->format('d-m-Y');}}</td>
                      </tr>                      
                    </tbody>
                  </table>
                  
                  <a href="{{URL::route('movimientos.cliente', array('cliente_id' => $usuario->id))}}" class="btn btn-primary">Movimientos Realizados</a>
                  {{--<a href="{{URL::previous()}}" class="btn btn-primary">Volver</a>--}}
                </div>
              </div>
            </div>
                 <div class="panel-footer">
                        {{--<a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>--}}
                        <span class="pull-right">
                            <a href="edit.html" data-original-title="Editar Usuario" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Eliminar Usuario" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                    </div>
            
          </div>
        </div>
      </div>
    </div>
  <a href="{{URL::previous()}}"><button class="btn btn-lg btn-primary btn-block" type="submit">Volver</button></a>

    @stop