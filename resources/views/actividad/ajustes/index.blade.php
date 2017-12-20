@extends('layouts.app')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ajustes
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Ajustes</li>
      </ol>
    </section>

    <section class="content container-fluid">

<a href="{{ url('profesores')}}">
      <div class="col-md-2 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Profesores</span>
            <p>Ingresar</p>
          </div>
        </div>
      </div>
</a>

<a href="{{ url('actividad')}}">
      <div class="col-md-2 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="fa fa-child"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Actividades</span>
            <p>Ingresar</p>
          </div>
        </div>
      </div>
</a>

<a href="{{ url('intermediario')}}">
      <div class="col-md-2 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Intermediarios</span>
            <p>Ingresar</p>
          </div>
        </div>
      </div>
</a>

    </section>




@endsection
