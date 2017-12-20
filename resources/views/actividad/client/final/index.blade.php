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
      @if(Auth::user()->rol_id <= 2)
        <a class="btn btn-app" href="{{ url('clientes/create')}}">
          <i class="fa fa-plus"></i> Añadir
        </a>
      @endif


      @if(session()->has('message'))
      	 <div class="alert alert-success alert-dismissible">
      		 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      		 <h4><i class="icon fa fa-check"></i> Realizado!</h4>
      		 {{session()->get('message')}}
      	 </div>
	    @endif

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Clientes</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
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
                  <td><a href="{{ url('clientes/'.$key->id)}}">{{$key->nombre}}</a></td>
                  <td><a href="mailto:{{$key->correo}}">{{$key->correo}}</a></td>
                  <td><a href="{{ url('sedes/create/'.$key->id)}}"><i class="fa fa-search"></i></a></td>
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
