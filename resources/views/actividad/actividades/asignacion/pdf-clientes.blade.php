<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CorporalEXP</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">

  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css')}}">

  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css')}}">

  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css')}}">

  <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css')}}">

  <link rel="stylesheet" href="{{ asset('dist/css/skins/skin-blue.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css')}}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<link href="https://getbootstrap.com/docs/4.0/examples/album/album.css" rel="stylesheet">

  <script src="{{ asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset('bower_components/growl/jquery.bootstrap-growl.min.js')}}"></script>
<style>
.negroC{
  color: black;
}
</style>

</head>


<body class="hold-transition">
  <header class=" ">
    <center>
    <img src="{{ asset('img/logo_complet.png')}}" width="50%">
</center>
  </header>

    <div class="wrapper">
      <div class=" ">
        <section class="content container-fluid">

@foreach ($rows as $row)

          <div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username">{{$row->actividad->sede->cliente->nombre}}</h3>
              <h5 class="widget-user-desc">{{$row->actividad->sede->direccion}}</h5>
            </div>

          </div>
          <!-- /.widget-user -->
        </div>

    <div class="col-md-4">
          <div class="box box-primary">
            <div class="box-body box-profile">



                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>Actividad</b> <a class="pull-right negroC">{{$row->actividad->actividad->nombre}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Fecha Realizada</b>
                      @if ($row->fecha == null)
                        <a class="pull-right negroC">Sin realizar</a>
                      @else
                        <a class="pull-right negroC">{{$row->fecha}}</a>
                      @endif

                    </li>

                    <li class="list-group-item">
                      <b>Hora Realizada</b> <a class="pull-right negroC">
                        @if ($row->hora_inicio == null)
                          Sin Realizar
                        @else
                          <?php $hora_inicio = \Carbon\Carbon::parse($row->hora_inicio); ?>{{$hora_inicio->format('h:i A')}}
                          a
                          <?php $hora_final = \Carbon\Carbon::parse($row->hora_final); ?>{{$hora_final->format('h:i A')}}
                        @endif

                      </a>
                    </li>
                    <li class="list-group-item">
                      <b>Profesional</b> <a class="pull-right negroC">{{$row->usuario->name}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Observaciones</b> <a class="pull-right negroC">{{$row->observaciones}}</a><br><br>
                    </li>
                  </ul>
                </div>
            </div>
    </div>


    <div class="col-md-4">
          <div class="box box-primary">
                    <div class="box-body box-profile">

                          <p class="text-muted text-center"></p>

                          <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                              <b>Contacto</b> <a class="pull-right negroC">{{$row->actividad->sede->contacto}}</a>
                            </li>
                            <li class="list-group-item">
                              <b>Correo</b> <a class="pull-right negroC">{{$row->actividad->sede->correo}}</a>
                            </li>
                            <li class="list-group-item">
                              <b>Telefono</b> <a class="pull-right negroC">{{$row->actividad->sede->telefono}}</a>
                            </li>
                          </ul>
                        </div>
            </div>
    </div>

@endforeach


    <footer class="main-footer">
        <!-- To the right -->

        <!-- Default to the left -->
        <strong>Copyright &copy; 2017 <a href="http://corporalexperience.com">CorporalExperience</a>.</strong> All rights reserved.
      </footer>

    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body box-profile">
          <div class="row margin-bottom">
            <!-- /.col -->
            <div class="col-sm-12">
              <div class="row">

                {{-- @foreach ($imagenes as $imagen)


                <div class="col-sm-3">
                  <img class="img-responsive" src="{{ asset('storage/actividad/fotos/'.$imagen->nombre)}}" alt="Imagen">
                  <br>
                </div>

                @endforeach --}}

                <!--  /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.col -->
          </div>
        </div>
      </div>
    </div>





    </section>

















      </div>




    </div>
</body>
</html>
