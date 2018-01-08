@extends('layouts.app')


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Bienvenido
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Home</li>
      </ol>
    </section>


    <section class="content container-fluid">

      @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif

      <div class="col-lg-3 col-xs-6">
				<div class="small-box bg-aqua">
					<div class="inner">
						<h4>Programacion</h4>
						<p>Menú de actividades programadas</p>
					</div>
					<div class="icon">
						<i class="fa fa-calendar-plus-o"></i>
					</div>
					<a href="{{url('asignacion')}}"class="small-box-footer">Ingresar <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

      <div class="col-lg-3 col-xs-6">
				<div class="small-box bg-green">
					<div class="inner">
						<h4>Calendario</h4>
						<p>Calendario de programación</p>
					</div>
					<div class="icon">
						<i class="fa fa-calendar"></i>
					</div>
					<a href="{{url('calendario')}}"class="small-box-footer">Ingresar <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>

      @if(Auth::user()->rol_id <= 2)
        <div class="col-lg-3 col-xs-6">
  				<div class="small-box bg-red">
  					<div class="inner">
  						<h4>Gestión</h4>
  						<p>Proceso de clientes-sedes-actividades</p>
  					</div>
  					<div class="icon">
  						<i class="fa fa-object-group"></i>
  					</div>
  					<a href="{{url('clientes')}}"class="small-box-footer">Ingresar <i class="fa fa-arrow-circle-right"></i></a>
  				</div>
  			</div>

        <div class="col-lg-3 col-xs-6">
  				<div class="small-box bg-yellow">
  					<div class="inner">
  						<h4>Mas...</h4>
  						<p>Profes, participantes, etc.</p>
  					</div>
  					<div class="icon">
  						<i class="fa fa-odnoklassniki"></i>
  					</div>
  					<a href="{{url('ajustes')}}"class="small-box-footer">Ingresar <i class="fa fa-arrow-circle-right"></i></a>
  				</div>
  			</div>

        <div class="col-lg-3 col-xs-6">
  				<div class="small-box bg-maroon">
  					<div class="inner">
  						<h4>Informe</h4>
  						<p>Descargar informes.</p>
  					</div>
  					<div class="icon">
  						<i class="fa fa-bar-chart"></i>
  					</div>
  					<a href="{{url('informe')}}"class="small-box-footer">Ingresar <i class="fa fa-arrow-circle-right"></i></a>
  				</div>
  			</div>

     @endif
    </section>






@endsection
