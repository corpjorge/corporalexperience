@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Clientes
        <small>Resumen de clientes ingresados</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Clientes</li>
      </ol>
    </section>


    <section class="content container-fluid">

      <a class="btn btn-app" href="{{ url('clientes')}}">
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


      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Ingresar Cliente</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! Form::open(['url' => 'clientes', 'method' => 'post']) !!}
              <div role="form">
                <!-- text input -->
                <div class="form-group">
                  <label>Identificacion</label>
                  <input type="number" class="form-control" placeholder="Identificacion" name="identificacion">
                </div>
                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" class="form-control" placeholder="Nombre" name="nombre">
                </div>
                <div class="form-group">
                  <label>Telefono</label>
                  <input type="number" class="form-control" placeholder="Telefono" name="telefono">
                </div>
                <div class="form-group">
                  <label>Correo</label>
                  <input type="email" class="form-control" placeholder="Correo" name="correo">
                </div>
                <div class="form-group">
                  <label>Contacto</label>
                  <input type="text" class="form-control" placeholder="Contacto" name="contacto">
                </div>
                <div class="form-group">
                  <label>¿Es intermediario?</label><br>
                  <label style="font-weight: 400;">
                    SI <input type="radio" name="opc_intermediario" class="flat-red" value="SI" id="ocultar"> &nbsp
                  </label>
                  <label style="font-weight: 400;">
                    NO <input type="radio" name="opc_intermediario" class="flat-red" value="NO" id="mostrar">
                  </label>

                  <div class="form-group" id="target" style="display: none;">
                    <div class="form-group">
                      <select class="form-control select2" style="width: 100%;" name="intermediario">
                        <option selected="selected" value="">¿Cual?</option>
                      @foreach ($rows as $key)
                        <option value="{{$key->id}}">{{$key->nombre}}</option>
                      @endforeach
                      </select>
                    </div>
                  </div>

                </div>

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" name="guardar" value="guardar">Guardar</button>
                  {{-- <button type="submit" class="btn btn-success" name="sedes" value="sedes"><i class="fa fa-fw fa-plus"></i> Sedes</button> --}}
                  <a type="button" class="btn btn-default" href="{{ url('clientes')}}">Cancelar</a>
                </div>

              </div>
              {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
          </div>

    </section>

    <script>
       $('#ocultar').on('ifChecked', function(event){
          $('#target').hide("fast");
       });
       $('#mostrar').on('ifChecked', function(event){
          $('#target').show("slow");
       });
    </script>


@endsection
