@extends('layouts.app')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Calendarios
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Calendarios</li>
      </ol>
    </section>

    <section class="content container-fluid" style="min-height: 0px;">
      <a href="{{ url('programar')}}">
            <div class="col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fa fa-plus"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Todos</span>
                  <p>Ingresar</p>
                  <small style="font-weight: 300; font-size: 15px; color: #777">Calendario completo</small>
                </div>
              </div>
            </div>
      </a>



    </section>
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-tag"></i> Calendario de usuarios</h3>
            </div>
            <div class="box-body">
              <div class="row">

                @foreach ($rows as $key)

                <a href="{{ url('calendario/'.$key->id)}}">
                      <div class="col-sm-6 col-xs-12">
                        <div class="info-box">
                          <span class="info-box-icon bg-aqua"><i class="fa fa-calendar"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-text">{{$key->name}}</span>
                            <p>Ingresar</p>
                            <small style="font-weight: 300; font-size: 15px; color: #777">Actividades del profe</small>
                          </div>
                        </div>
                      </div>
                </a>

                @endforeach



                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>

    </section>


@endsection
