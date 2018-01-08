@extends('layouts.app')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profesores
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Profesores</li>
      </ol>
    </section>

    @if(session()->has('message'))
       <div class="alert alert-success alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         <h4><i class="icon fa fa-check"></i> Realizado!</h4>
         {{session()->get('message')}}
       </div>
    @endif

    <section class="content container-fluid">

      <a class="btn btn-app" href="{{ url('profesores/create/')}}">
        <i class="fa fa-plus"></i> Añadir profesor
      </a>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Profesores</h3>

   
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Correo</th>
                </tr>
                @foreach ($rows as $key)
                <tr>
                  <td>{{$key->id}}</td>
                  <td><a href="{{ url('profesores/'.$key->id)}}"><i class="fa fa-eye"></i></a> {{$key->name}}</td>
                  <td><a href="mailto:{{$key->email}}"><i class="fa fa-envelope"></i></a> {{$key->email}} </td>
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
