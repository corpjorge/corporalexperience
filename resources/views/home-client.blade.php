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

      <div class="row">

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-flag-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">En proceso</span>
              <span class="info-box-number" id="total"></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>


      <div class="row">

        {{-- <div class="col-xs-4">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="file" id="exampleInputFile">

                  <p class="help-block">Example block-level help text here.</p>
                </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox"> Check me out
                  </label>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div> --}}

        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Actividades del dia: {{$carbon->format('Y-m-d')}}</h3> <a href=""><i class="fa fa-refresh"></i></a>
              <div class="box-tools">
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover" >
                <tbody><tr>
                  <th>#</th>
                  <th>Cliente</th>
                  <th>Hora</th>
                  <th>Sede</th>
                </tr>
                <?php $i=1  ?>
                @foreach ($actHoy as $key)
                @if ($key->actividad->sede->cliente->intermediario->identificacion == Auth::user()->documento)
                  <?php
                   $total = $i++;
                  ?>
                <tr id="tabla_sedes">
                  <td>{{$key->id}}</td>
                  <td>{{$key->actividad->sede->cliente}}</td>
                  <td>
                    <?php $hora_inicio = \Carbon\Carbon::parse($key->hora_inicio); ?>{{$hora_inicio->format('h:i A')}}
                    a
                    <?php $hora_final = \Carbon\Carbon::parse($key->hora_final); ?>{{$hora_final->format('h:i A')}}
                  </td>
                  <td><a href="{{ url('sedes/'.$key->actividad->sede->id)}}">{{$key->actividad->sede->direccion}}</a></td>
                </tr>

                @endif
                @endforeach
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
{{ $actHoy->links() }}


    </section>


    <script type="text/javascript">
    @isset($total)
        $('#total').text({{$total}});
    @endisset
    </script>



@endsection
