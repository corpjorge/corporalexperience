@extends('layouts.app')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Asignacion
        <small>Resumen de las Asignaciones</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Asignacion</li>
      </ol>
    </section>

    <section class="content container-fluid" style="min-height: 0px;">
      <a href="{{ url('programar')}}">
            <div class="col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fa fa-plus"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Programar actividad</span>
                  <p>Ingresar</p>
                  <small style="font-weight: 300; font-size: 15px; color: #777">Añade una actividad a un cliente</small>
                </div>
              </div>
            </div>
      </a>



    </section>
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i> Estado actividades programadas</h3>
        </div>
        <div class="box-body">
          <div class="row">

            <a href="{{ url('programar/1')}}">
                  <div class="col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-gray"><i class="fa fa-"></i>{{$sinAsignar}}</span>
                      <div class="info-box-content">
                        <span class="info-box-text">Sin asignar</span>
                        <p>Ingresar</p>
                        <small style="font-weight: 300; font-size: 15px; color: #777">Actividades sin profe asignado</small>
                      </div>
                    </div>
                  </div>
            </a>

            <a href="{{ url('programar/2')}}">
                  <div class="col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-aqua"><i class="fa fa-"></i>{{$sinConfirmar}}</span>
                      <div class="info-box-content">
                        <span class="info-box-text">Sin Confirmar</span>
                        <p>Ingresar</p>
                        <small style="font-weight: 300; font-size: 15px; color: #777">No se le ha confirmado al profe</small>
                      </div>
                    </div>
                  </div>
            </a>

            <a href="{{ url('programar/3')}}">
                  <div class="col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-orange"><i class="fa fa-"></i>{{$pendiente}}</span>
                      <div class="info-box-content">
                        <span class="info-box-text">Pendiente</span>
                        <p>Ingresar</p>
                        <small style="font-weight: 300; font-size: 15px; color: #777">Pendiente por ejecución</small>
                      </div>
                    </div>
                  </div>
            </a>

            <a href="{{ url('programar/4')}}">
                  <div class="col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-red"><i class="fa fa-"></i>{{$atrasado}}</span>
                      <div class="info-box-content">
                        <span class="info-box-text">Atrazado</span>
                        <p>Ingresar</p>
                        <small style="font-weight: 300; font-size: 15px; color: #777">No sé a realizado</small>
                      </div>
                    </div>
                  </div>
            </a>

            <a href="{{ url('programar/0')}}">
                  <div class="col-sm-6 col-xs-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-green"><i class="fa fa-search"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Todas</span>
                        <p>Ingresar</p>
                        <small style="font-weight: 300; font-size: 15px; color: #777">Todas las actividades</small>
                      </div>
                    </div>
                  </div>
            </a>

            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>

</section>


@endsection
