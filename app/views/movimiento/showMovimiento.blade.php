@extends ('index')


@section ('title') Detalle de Movimiento @stop

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
        <p class=" text-info">{{Lang::setLocale('es');}} {{Date::now()->format('l j F Y H:i:s');}}</p>
      </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Detalle de Movimiento de "{{Usuario::find($movimiento->cliente_id)->nombre_completo}}"</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                {{--<div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle"> </div>--}}
                
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
                        <td>-Codigo- :</td>
                        <td>{{$movimiento->id}}</td>
                      </tr>
                      <tr>
                        <td>-Tipo- :</td>
                        <td>{{$movimiento->tipo}}</td>
                      </tr>
                      <tr>
                        <td>-Monto- :</td>
                        <td>S/. {{$movimiento->monto}}</td>
                      </tr>
                      <tr>
                        <td>-Nota- :</td>
                        <td>{{$movimiento->nota}}</td>
                      </tr>
                      <tr>
                        <td>-Realizado Por- :</td>
                        <td>{{Usuario::find($movimiento->trabajador_id)->nombre_completo}}</td>
                      </tr>
                      <tr>
                        <td>-Origen de Movimiento- :</td>
                        <td>{{$movimiento->origen_mov}}</td>
                      </tr>
                      <tr>
                        <td>-Creado el- :</td>
                        <td>{{Date::parse($movimiento->created_at)->format('d-m-Y');}}</td>
                      </tr>
                      <tr>
                        <td>-Modificado el- :</td>
                        <td>{{Date::parse($movimiento->updated_at)->format('d-m-Y');}}</td>
                      </tr>
                    </tbody>
                  </table>
                  
                  <a href="{{URL::route('movimientos.admin', array('cliente_id' => $movimiento->cliente_id))}}" class="btn btn-primary">Movimientos de Cliente</a>
                  {{--<a href="{{URL::previous()}}" class="btn btn-primary">Volver</a>--}}
                </div>
              </div>
            </div>
                 <div class="panel-footer">
                        {{--<a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>--}}
                        <span class="pull-right">
                            <a href="{{URL::route('movimientos.edit', array('id' => $movimiento->id))}}" data-original-title="Editar Usuario" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            {{--URL::action('MovimientoController@destroy', array('id' => $movimiento->id))}}--}}
                            <a href="{{URL::route('movimientos.destroy', array('id' => $movimiento->id))}}" data-original-title="Eliminar Usuario" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                    </div>
            
          </div>
        </div>
      </div>
    </div>
  <a href="{{URL::previous()}}"><button class="btn btn-lg btn-primary btn-block" type="submit">Volver</button></a>

    @stop