@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Intermediario
        <small>ID: {{$row->id}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Intermediario</li>
      </ol>
    </section>

    <section class="content container-fluid">

      <a class="btn btn-app" href="{{ url('intermediario')}}">
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


                    <h3 class="profile-username text-center">{{$row->nombre}}</h3>

                    <p class="text-muted text-center">{{$row->identificacion}}</p>

                    <ul class="list-group list-group-unbordered">
                      <li class="list-group-item">
                        <b>Telefono</b> <a class="pull-right">{{$row->telefono}}</a><br><br>
                      </li>
                      <li class="list-group-item">
                        <b>correo</b> <a class="pull-right">{{$row->correo}}</a><br><br>
                      </li>
                      <li class="list-group-item">
                        <b>Contacto</b> <a class="pull-right">{{$row->contacto}}</a><br><br>
                      </li>
                    </ul>

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
                    <li class="active"><a href="#clientes" data-toggle="tab">Clientes</a></li>
                    <li><a href="#settings" data-toggle="tab">Datos</a></li>

                  </ul>
                  <div class="tab-content">
                    <div class="active tab-pane" id="clientes">

                      <div class="row">
                        <div class="col-xs-12">

                            <!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                              <table class="table table-hover">
                                <tbody><tr>
                                  <th>#</th>
                                  <th>Nombre</th>
                                  <th>Correo</th>
                                  <th>Sedes</th>
                                </tr>
                                @foreach ($rows as $key)
                                <tr>
                                  <td>{{$key->id}}</td>
                                  <td><a href="{{ url('clientes/'.$key->id)}}"><i class="fa fa-eye"></i></a> {{$key->nombre}}</td>
                                  <td><a href="mailto:{{$key->correo}}"><i class="fa fa-envelope"></i></a> {{$key->correo}}</td>
                                  <td><a href="{{ url('sedes/create/'.$key->id)}}"><i class="fa fa-search"></i></a></td>
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
                      {!! Form::open(['url' => 'intermediario/'.$row->id, 'method' => 'PUT']) !!}
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
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo" value="{{$row->nombre}}" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="telefono" class="col-sm-2 control-label">telefono</label>

                          <div class="col-sm-10">
                            <input type="number" class="form-control" id="telefono" name="telefono" placeholder="telefono" value="{{$row->telefono}}" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="correo" class="col-sm-2 control-label">correo</label>
                          <div class="col-sm-10">
                            <input type="email" class="form-control" id="correo" name="correo" placeholder="correo" value="{{$row->correo}}" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="contacto" class="col-sm-2 control-label">contacto</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="contacto" name="contacto" placeholder="contacto" value="{{$row->contacto}}" required>
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
