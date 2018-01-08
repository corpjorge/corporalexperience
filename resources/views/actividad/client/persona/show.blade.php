@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Participante
        <small>ID: {{$row->id}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Participante</li>
      </ol>
    </section>

    <section class="content container-fluid">

      <a class="btn btn-app" href="{{ url('personas/'.$row->act_client_final_id.'/cliente')}}">
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
              <div class="col-md-12">

                <!-- Profile Image -->
                <div class="box box-primary">
                  <div class="box-body box-profile">


                    <h3 class="profile-username text-center">{{$row->nombre}}</h3>

                    <p class="text-muted text-center">{{$row->identificacion}}</p>

                    <ul class="list-group list-group-unbordered">
                      <li class="list-group-item">
                        <b>Proceso</b> <a class="pull-right">{{$row->proceso}}</a>
                      </li>
                      <li class="list-group-item">
                        <b>Telefono</b> <a class="pull-right">{{$row->telefono}}</a>
                      </li>
                      <li class="list-group-item">
                        <b>Email</b> <a class="pull-right">{{$row->correo}}</a>
                      </li>
                      <li class="list-group-item">
                        <b>Cliente</b> <a class="pull-right">{{$row->cliente->nombre}}</a>
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

              <!-- /.col -->
            </div>


</section>



@endsection
