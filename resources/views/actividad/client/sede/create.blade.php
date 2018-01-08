@extends('layouts.app')

@section('content')


<style>
html,body{
  /*margin:0px;
  height:100%;*/
}

.controls {
    margin-top: 10px;
    border: 1px solid transparent;
    border-radius: 2px 0 0 2px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    height: 32px;
    outline: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
  }

  #pac-input {
    background-color: #fff;
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
    margin-left: 12px;
    padding: 0 11px 0 13px;
    text-overflow: ellipsis;
    width: 200px;
  }

  #pac-input:focus {
    border-color: #4d90fe;
  }

  .pac-container {
    font-family: Roboto;
  }

  #type-selector {
    color: #fff;
    background-color: #4d90fe;
    padding: 5px 11px 0px 11px;
  }

  #type-selector label {
    font-family: Roboto;
    font-size: 13px;
    font-weight: 300;
  }
  #target {
    width: 345px;
  }

</style>



    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sedes de <b style="color:red">{{$row->nombre}}</b>
        <small>Resumen de las sedes de {{$row->nombre}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Clientes</li>
      </ol>
    </section>


    <section class="content container-fluid">

      <a class="btn btn-app" href="{{ url('clientes')}}">
        <i class="fa fa-arrow-left"></i> Clientes Gestion
      </a>
@if (Auth::user()->rol_id <= 2)
      <a class="btn btn-app" id="Addsede">
        <i class="fa fa-plus"></i> Añadir Sede
      </a>
@endif
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


      <div class="box box-primary" id="agregarSede" style="display: none;" >
            <div class="box-header with-border">
              <h3 class="box-title">Ingresar Sedes:</b></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! Form::open(['url' => 'sedes/'.$row->id, 'method' => 'post', 'id' => 'form_sedes']) !!}
              <div role="form">
                <!-- text input -->
              <div class="col-md-3">
                <div class="form-group">
                  <label>Contacto</label>
                  <input type="text" class="form-control" placeholder="Nombre del contacto" name="contacto" value="{{$row->contacto}}" required >
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Cargo</label>
                  <input type="text" class="form-control" placeholder="Cargo del contacto" name="contacto_cargo" >
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Correo</label>
                  <input type="email" class="form-control" placeholder="Correo" name="correo" value="{{$row->correo}}">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Teléfono</label>
                  <input type="number" class="form-control" placeholder="Teléfono" name="telefono" value="{{$row->telefono}}">

                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <img src="{{ asset('img/marcador.png')}}" id="marcador">
                  <input id="pac-input" class="controls" type="text" placeholder="Dirección Sede" name="direccion" >
                  <div id="map" style="width:100%;min-height:300px;"></div>
                </div>
              </div>

              <input type="hidden" name="lat" id="lat">
              <input type="hidden" name="lng" id="lng">

              </div>

            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-success" name="sedes" value="sedes" id="enviar"><i class="fa fa-fw fa-plus"></i> Añadir Sede</button>
              <a class="btn btn-default" href="" >Cancelar</a>
            </div>
            <!-- /.box-body -->
          </div>
{!! Form::close() !!}

                @if(session()->has('message'))
                	 <div class="alert alert-success alert-dismissible">
                		 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                		 <h4><i class="icon fa fa-check"></i> Realizado!</h4>
                		 {{session()->get('message')}}
                	 </div>
          	    @endif

                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                      <b><i class="fa fa-info"></i> Note:</b><br>
                        Para agregar una sede de clic en el botón <i class="fa fa-plus"></i></b><br>
                        <b style="color:red">Importante</b> el campo en el mapa llamado <b>Dirección Sede</b> debe ser correcto y no puede estar en blanco<br>
                        Una vez agregada la sede tendrá la opción <b>ver y añadir <i class="fa fa-arrow-circle-right"></i></b> para gestionar las Programacion<br>
                        Para ver los detalles de clic en el icono <i class="fa fa-eye"></i><br>
                        Para ver la dirección en <i class="fa fa-google"></i>oogle Maps de clic en el icono <i class="fa fa-map-marker"></i>
                </p>

                <div class="row">
                  <div class="col-xs-12">
                    <div class="box">
                      <div class="box-header">
                        <h3 class="box-title">Sedes de {{$row->nombre}}</h3> <a href=""><i class="fa fa-refresh"></i></a> 
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body table-responsive no-padding">
                        <table class="table table-hover" >
                          <tbody><tr>
                            <th>#</th>
                            <th>Dirección</th>
                            <th>Contacto</th>
                            <th>Telefono</th>
                            <th>Programación</th>
                          </tr>
                          @foreach ($rows as $key)
                          <tr id="tabla_sedes">
                            <td>{{$key->id}}</td>
                            <td><a href="https://maps.google.com/?q={{$key->lat}},{{$key->lng}}" target="_blank"> <i class="fa fa-map-marker"></i></a> {{$key->direccion}}</td>
                            <td><a href="{{ url('sedes/'.$key->id)}}"><i class="fa fa-eye"></i></a> {{$key->contacto}}</td>
                            <td>{{$key->telefono}}</td>
                            <td><a href="{{ url('actividades-client/create/'.$key->id)}}">Ver y añadir <i class="fa fa-arrow-circle-right"></i></a></td>
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


<script src="{{ asset('js/maps_create.js')}}"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5JVn06z1NKzHt58eCo-XXLNsvemOiXXs&libraries=places&callback=initMap"></script>

<script>
/*
$(document).ready(function(){
  $("#enviar").click(function(e){

    e.preventDefault();

    //var row = $("#tabla_sedes");
    var form = $('#form_sedes');
    var url  = form.attr('action');
    var data = form.serialize();


    $.post(url, data, function(result){
      // alert(result);
      $.bootstrapGrowl("Sede añadida!", {
        ele: 'body', // which element to append to
        type: 'success', // (null, 'info', 'danger', 'success')
        offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
        align: 'center', // ('left', 'right', or 'center')
        width: 250, // (integer, or 'auto')
        delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
        allow_dismiss: true, // If true then will display a cross to close the popup.
        stackup_spacing: 10 // spacing between consecutively stacked growls.
      });

      //row.show();

    }).fail(function(){
      $.bootstrapGrowl("No se agregó sede", {
        ele: 'body', // which element to append to
        type: 'danger', // (null, 'info', 'danger', 'success')
        offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
        align: 'center', // ('left', 'right', or 'center')
        width: 250, // (integer, or 'auto')
        delay: 4000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
        allow_dismiss: true, // If true then will display a cross to close the popup.
        stackup_spacing: 10 // spacing between consecutively stacked growls.
      });
    })
  });


})
*/


</script>




@endsection
