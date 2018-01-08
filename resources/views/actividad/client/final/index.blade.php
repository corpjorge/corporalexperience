@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gestión - CLIENTES
        <small>Gestiona tus clientes</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Clientes</li>
      </ol>
    </section>


    <section class="content container-fluid">
      @if(Auth::user()->rol_id <= 2)
        <a class="btn btn-app" href="{{ url('clientes/create')}}">
          <i class="fa fa-plus"></i> Añadir Cliente
        </a>
      @endif

      @isset($limpiar)
    		<a class="btn btn-app" href="{{ url('clientes')}}">
    	  	<i class="fa fa-eraser"></i>Limpiar Busqueda
    	  </a>
    	@endisset


      @if(session()->has('message'))
      	 <div class="alert alert-success alert-dismissible">
      		 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      		 <h4><i class="icon fa fa-check"></i> Realizado!</h4>
      		 {{session()->get('message')}}
      	 </div>
	    @endif

      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            <b><i class="fa fa-info"></i> Note:</b><br>
              Para agregar un cliente de clic en el botón <i class="fa fa-plus"></i></b><br>
              Una vez añadido el cliente tendrá la opción <b>ver y añadir <i class="fa fa-arrow-circle-right"></i></b> para gestionar las sedes<br>
              Para ver los detalles de clic en el icono <i class="fa fa-eye"></i>
      </p>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Clientes</h3>

              <div class="box-tools">
                {!! Form::open(['url' => 'buscar/nit', 'method' => 'post']) !!}
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="number" name="dato" class="form-control pull-right" placeholder="Nit">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
                {!! Form::close() !!}
              </div>

            </div>


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
                  <td><a href="{{ url('clientes/'.$key->id)}}"><i class="fa fa-eye"></i></a> {{$key->nombre}} </td>
                  <td><a href="mailto:{{$key->correo}}"><i class="fa fa-envelope"></i></a> {{$key->correo}}</td>
                  <td><a href="{{ url('sedes/create/'.$key->id)}}"> Ver y añadir <i class="fa fa-arrow-circle-right"></i></a></td>
                </tr>
                @endforeach
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

{{ $rows->links() }}


    </section>


@endsection
