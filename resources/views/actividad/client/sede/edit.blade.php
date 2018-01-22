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
        Sedes
        <small>Resumen de las sedes</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Clientes</li>
      </ol>
    </section>

    <section class="content container-fluid">

      <a class="btn btn-app" href="{{ url('sedes/'.$row->id)}}">
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


      <div class="box box-primary" id="agregarSede" >
            <div class="box-header with-border">
              <h3 class="box-title">Ingresar Sedes a:<br><br><b> {{$row->nombre}}</b></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! Form::open(['url' => 'sedes/'.$row->id, 'method' => 'PUT']) !!}
              <div role="form">
                <!-- text input -->
              <div class="col-md-3">
                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" class="form-control" placeholder="Nombre de la sede" name="nombre" value="{{$row->nombre}}" required >
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Contacto</label>
                  <input type="text" class="form-control" placeholder="Nombre del contacto" name="contacto" value="{{$row->contacto}}" required >
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Cargo</label>
                  <input type="text" class="form-control" placeholder="Cargo del contacto" name="contacto_cargo" value="{{$row->contacto_cargo}}">
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

              <div class="col-md-3">
                <div class="form-group">
                  <label>Observación</label>
                  <input type="text" class="form-control" placeholder="Mas datos de direccion" name="observacion" value="{{$row->observacion}}" required >
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <img src="{{ asset('img/marcador.png')}}" id="marcador">
                  <input id="pac-input" class="controls" type="text" placeholder="Dirección Sede" name="direccion" value="{{$row->direccion}}">
                  <div id="map" style="width:100%;min-height:300px;"></div>
                </div>
              </div>

              <input type="hidden" id="lat" name="lat" value="{{$row->lat}}">
              <input type="hidden" id="lng" name="lng" value="{{$row->lng}}">

              </div>

            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-success">Actualizar</button>

            </div>
            <!-- /.box-body -->
          </div>
{!! Form::close() !!}





    </section>


<script>
  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {
        lat: 4.710988599999999,
        lng: -74.0720292
      },
      zoom: 17,
      mapTypeControl: false,
      mapTypeId: 'roadmap',
      gestureHandling: 'greedy',
      styles: [{
          "elementType": "geometry",
          "stylers": [{
            "color": "#1d2c4d"
          }]
        },
        {
          "elementType": "labels.text.fill",
          "stylers": [{
            "color": "#8ec3b9"
          }]
        },
        {
          "elementType": "labels.text.stroke",
          "stylers": [{
            "color": "#1a3646"
          }]
        },
        {
          "featureType": "administrative.country",
          "elementType": "geometry.stroke",
          "stylers": [{
            "color": "#4b6878"
          }]
        },
        {
          "featureType": "administrative.land_parcel",
          "elementType": "labels.text.fill",
          "stylers": [{
            "color": "#64779e"
          }]
        },
        {
          "featureType": "administrative.province",
          "elementType": "geometry.stroke",
          "stylers": [{
            "color": "#4b6878"
          }]
        },
        {
          "featureType": "landscape.man_made",
          "elementType": "geometry.stroke",
          "stylers": [{
            "color": "#334e87"
          }]
        },
        {
          "featureType": "landscape.natural",
          "elementType": "geometry",
          "stylers": [{
            "color": "#023e58"
          }]
        },
        {
          "featureType": "poi",
          "elementType": "geometry",
          "stylers": [{
            "color": "#283d6a"
          }]
        },
        {
          "featureType": "poi",
          "elementType": "labels.text.fill",
          "stylers": [{
            "color": "#6f9ba5"
          }]
        },
        {
          "featureType": "poi",
          "elementType": "labels.text.stroke",
          "stylers": [{
            "color": "#1d2c4d"
          }]
        },
        {
          "featureType": "poi.park",
          "elementType": "geometry.fill",
          "stylers": [{
            "color": "#023e58"
          }]
        },
        {
          "featureType": "poi.park",
          "elementType": "labels.text.fill",
          "stylers": [{
            "color": "#3C7680"
          }]
        },
        {
          "featureType": "road",
          "elementType": "geometry",
          "stylers": [{
            "color": "#304a7d"
          }]
        },
        {
          "featureType": "road",
          "elementType": "labels.text.fill",
          "stylers": [{
            "color": "#98a5be"
          }]
        },
        {
          "featureType": "road",
          "elementType": "labels.text.stroke",
          "stylers": [{
            "color": "#1d2c4d"
          }]
        },
        {
          "featureType": "road.highway",
          "elementType": "geometry",
          "stylers": [{
            "color": "#2c6675"
          }]
        },
        {
          "featureType": "road.highway",
          "elementType": "geometry.stroke",
          "stylers": [{
            "color": "#255763"
          }]
        },
        {
          "featureType": "road.highway",
          "elementType": "labels.text.fill",
          "stylers": [{
            "color": "#b0d5ce"
          }]
        },
        {
          "featureType": "road.highway",
          "elementType": "labels.text.stroke",
          "stylers": [{
            "color": "#023e58"
          }]
        },
        {
          "featureType": "transit",
          "elementType": "labels.text.fill",
          "stylers": [{
            "color": "#98a5be"
          }]
        },
        {
          "featureType": "transit",
          "elementType": "labels.text.stroke",
          "stylers": [{
            "color": "#1d2c4d"
          }]
        },
        {
          "featureType": "transit.line",
          "elementType": "geometry.fill",
          "stylers": [{
            "color": "#283d6a"
          }]
        },
        {
          "featureType": "transit.station",
          "elementType": "geometry",
          "stylers": [{
            "color": "#3a4762"
          }]
        },
        {
          "featureType": "water",
          "elementType": "geometry",
          "stylers": [{
            "color": "#0e1626"
          }]
        },
        {
          "featureType": "water",
          "elementType": "labels.text.fill",
          "stylers": [{
            "color": "#4e6d70"
          }]
        }
      ]

    });

    var pos = {
      lat: {{$row->lat}},
      lng: {{$row->lng}}
    };
    map.setCenter(pos);

    var input = document.getElementById('pac-input');
    var marcador = document.getElementById('marcador');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    map.controls[google.maps.ControlPosition.CENTER].push(marcador);

    map.addListener('bounds_changed', function() {
      searchBox.setBounds(map.getBounds());
    });

    searchBox.addListener('places_changed', function() {
      var places = searchBox.getPlaces();

      if (places.length == 0) {
        return;
      }

      localicacion = places[0]['geometry']['location'];

      lat = localicacion.lat;
      lng = localicacion.lng;
      $("#lat").val(lat);
      $("#lng").val(lng);

      map.setCenter(localicacion);

    });


    map.addListener('dragend', function() {
      localicacion = map.getCenter();
      lat = localicacion.lat;
      lng = localicacion.lng;
      $("#lat").val(lat);
      $("#lng").val(lng);

      localicacion = localicacion.toString()
      localicacion = localicacion.replace('(', '');
      localicacion = localicacion.replace(')', '');
      url_Geo = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyB5JVn06z1NKzHt58eCo-XXLNsvemOiXXs&latlng=";

      $.getJSON(url_Geo + localicacion, function(result) {
        direccion = result.results[0]['formatted_address'];
        $("#pac-input").val(direccion);
      });
    });



  }

  $(document).ready(function() {
    $("form").keypress(function(e) {
      if (e.which == 13) {
        return false;
      }
    });
  });
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5JVn06z1NKzHt58eCo-XXLNsvemOiXXs&libraries=places&callback=initMap"></script>





@endsection
