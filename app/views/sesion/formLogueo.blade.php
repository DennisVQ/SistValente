@extends ('index')


@section ('title') Registrar Usuario @stop

@section ('cabecera')
@stop

@section('contenido')

<div class="container">
        <div id="loginbox" style="margin-top: 150px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Iniciar Sesion</div>
                        <!--<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">¿Olvidaste la Contraseña?</a></div>-->
                    </div>

                    {{-- Preguntamos si hay algún mensaje de error y si hay lo mostramos  --}}
                    @if(Session::has('mensaje_error'))
                        {{ Session::get('mensaje_error') }}
                    @endif
                    
                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            

                            <!--<form id="loginform" class="form-horizontal" role="form">-->
                            {{ Form::open(array('route' => 'sesiones.store', 'method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal')) }}
            
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="Usuario">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="Contraseña">
                            </div>
                                    

                                
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="remember-me"> Remember me
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
                                      <!--
                                      <a id="btn-login" href="#" class="btn btn-success">Login  </a>
                                      <a id="btn-fblogin" href="#" class="btn btn-primary">Login with Facebook</a>
                                      -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                        <a href="#">
                                            ¿Olvidaste la Contraseña?
                                        </a>
                                        </div>
                                    </div>
                                </div>   

                                <!--

                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account! 
                                        <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            Sign Up!
                                        </a>
                                        </div>
                                    </div>
                                </div>   
                                --> 
                            {{ Form::close() }}
                            <!--</form> -->



                        </div>                     
                    </div>  
        </div>

@stop