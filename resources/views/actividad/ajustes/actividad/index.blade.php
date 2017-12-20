@extends('layouts.app')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Actividad
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Actividad</li>
      </ol>
    </section>

    <section class="content container-fluid">

      <a class="btn btn-app" href="{{ url('actividad/create/')}}">
        <i class="fa fa-plus"></i> Añadir
      </a>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Actividades</h3>
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
                </tr>
                @foreach ($rows as $key)
                <tr>
                  <td>{{$key->id}}</td>
                  <td><a href="{{ url('actividad/'.$key->id.'/edit')}}">{{$key->nombre}}</a></td>
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
