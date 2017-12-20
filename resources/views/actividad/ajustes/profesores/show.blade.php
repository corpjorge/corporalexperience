@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profesor
        <small>ID: {{$row->id}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Profesores</li>
      </ol>
    </section>

    <section class="content container-fluid">

      <a class="btn btn-app" href="{{ url('profesores')}}">
        <i class="fa fa-arrow-left"></i> Atras
      </a>

      @if (count($errors) > 0)
  			<div class="alert alert-danger">
  					<strong>Error!</strong><br><br>
  					<ul>
  							@foreach ($errors->all() as $error)
  									<li>{{ $error }}</li>
  							@endforeach
  					</ul>
  			</div>
	    @endif

      @if(session()->has('message'))
         <div class="alert alert-success alert-dismissible">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
           <h4><i class="icon fa fa-check"></i> Realizado!</h4>
           {{session()->get('message')}}
         </div>
      @endif

      <div class="row">
              <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                  <div class="box-body box-profile">
                    @if ($row->avatar)
                      <img class="profile-user-img img-responsive img-circle" src="{{ $row->avatar}}" alt="User profile picture">
                    @else
                      <img class="profile-user-img img-responsive img-circle" src="{{ asset('dist/img/user.jpg')}}" alt="User profile picture">
                    @endif


                    <h3 class="profile-username text-center">{{$row->name}}</h3>

                    <p class="text-muted text-center">{{$row->documento}}</p>

                    <ul class="list-group list-group-unbordered">
                      <li class="list-group-item">
                        <b>Email</b> <a class="pull-right">{{$row->email}}</a>
                      </li>
                      <li class="list-group-item">
                        <b>Rol</b> <a class="pull-right">{{$row->rol->descripcion}}</a>
                      </li>
                    </ul>
                    @if ($row->estado == 1)
                      <button type="button" class="btn btn-danger btn-block" id="desactivar">
                        Desactivar Usuario
                      </button>
                    @else
                      <button type="button" class="btn btn-info btn-block" id="desactivar">
                        Activar Usuario
                      </button>
                    @endif
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->

                <!-- /.box -->
              </div>
              <!-- /.col -->
              <div class="col-md-9">
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Actividades</a></li>
                    <li><a href="#settings" data-toggle="tab">Datos</a></li>

                  </ul>
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">

                      <div class="row">
                        <div class="col-xs-12">


                            <!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                              <table class="table table-hover" >
                                <tbody><tr>
                                  <th>#</th>
                                  <th>Profesor</th>
                                  <th>Sede</th>
                                  <th>Estado</th>
                                </tr>
                                @foreach ($rows as $key)
                                <tr id="tabla_sedes">
                                  <td>{{$key->id}}</td>
                                  <td>{{$key->usuario->name}}<a href="" target="_blank"></td>
                                  <td><a href="{{ url('sedes/'.$key->actividad->sede->id)}}">{{$key->actividad->sede->direccion}}</a></td>
                                  <td><a href="{{ url('asignacion/'.$key->id)}}"><small class="label label-{{$key->estado->estilo}}"> {{$key->estado->descripcion}}</small></a></td>
                                </tr>
                                @endforeach
                              </tbody></table>
                            </div>
                            <!-- /.box-body -->

                          <!-- /.box -->
                        </div>
                      </div>

{{ $rows->links() }}
                    </div>

                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="settings">
                      {!! Form::open(['url' => 'profesores/'.$row->id, 'method' => 'PUT']) !!}
                      <div class="form-horizontal">
                        {{-- <div class="form-group">
                          <label for="documento" class="col-sm-2 control-label">Documento</label>

                          <div class="col-sm-10">
                            <input type="number" class="form-control" id="documento" placeholder="documento">
                          </div>
                        </div> --}}
                        <div class="form-group">
                          <label for="name" class="col-sm-2 control-label">Nombre</label>

                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre completo" value="{{$row->name}}" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="email" class="col-sm-2 control-label">Correo</label>

                          <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" placeholder="email" value="{{$row->email}}" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="password" class="col-sm-2 control-label">Contraseña</label>

                          <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password" placeholder="password" value="{{$row->password}}" >                     
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">Actualizar</button>
                          </div>
                        </div>
                      </div>
                      {!! Form::close() !!}
                    </div>


                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
              </div>
              <!-- /.col -->
            </div>


</section>


<script>
$(document).ready(function(){
  $("#desactivar").click(function(e){
    e.preventDefault();

    var url  = "{{ url('user-desactivar/'.$row->documento) }}";

    $.get(url, function(result){
      $.bootstrapGrowl(result, {
        ele: 'body', // which element to append to
        type: 'success', // (null, 'info', 'danger', 'success')
        offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
        align: 'center', // ('left', 'right', or 'center')
        width: 250, // (integer, or 'auto')
        delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
        allow_dismiss: true, // If true then will display a cross to close the popup.
        stackup_spacing: 10 // spacing between consecutively stacked growls.
      });
    }).fail(function(){
      $.bootstrapGrowl("Error", {
        ele: 'body', // which element to append to
        type: 'danger', // (null, 'info', 'danger', 'success')
        offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
        align: 'center', // ('left', 'right', or 'center')
        width: 250, // (integer, or 'auto')
        delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
        allow_dismiss: true, // If true then will display a cross to close the popup.
        stackup_spacing: 10 // spacing between consecutively stacked growls.
      });
    });
  });
})

</script>

@endsection
