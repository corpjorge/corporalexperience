@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sede
        <small>Sede de {{$row->cliente->nombre}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Clientes</li>
      </ol>
    </section>



    <section class="content container-fluid">

      <a class="btn btn-app" href="javascript:history.back()">
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

<div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body box-profile">

              <h3 class="profile-username text-center">{{$row->cliente->nombre}}</h3>
              @if (Auth::user()->rol_id <= 2)
                <a href="{{ url('sedes/'.$row->id.'/edit')}}"><p class="text-muted text-center"><i class="fa fa-edit" style="color:red;"></i> {{$row->direccion}}</p></a>
              @else
                <p class="text-muted text-center">{{$row->direccion}}</p>
              @endif

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Contacto</b> <a class="pull-right">{{$row->contacto}}</a>
                </li>
                <li class="list-group-item">
                  <b>Cargo</b> <a class="pull-right">{{$row->contacto_cargo}}</a>
                </li>
                <li class="list-group-item">
                  <b>Correo</b> <a class="pull-right">{{$row->correo}}</a>
                </li>
                <li class="list-group-item">
                  <b>Telefono</b> <a class="pull-right">{{$row->telefono}}</a>
                </li>
              </ul>
            </div>
        </div>
</div>

<div class="col-md-12">
  <div id="map" style="width:100%;min-height:400px;"></div>
</div>

</section>

<script>
function initMap() {

  var ubicacion = {
    lat: {{$row->lat}},
    lng: {{$row->lng}}
  };

  var map = new google.maps.Map(document.getElementById('map'), {
    center: ubicacion,
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

  var contentString = '<p>Dirección: {{$row->direccion}}, <br><a href="https://maps.google.com/?q={{$row->lat}},{{$row->lng}}" target="_blank">Abrir en Google maps</a> ';

  var infowindow = new google.maps.InfoWindow({
    content: contentString
  });

  marker = new google.maps.Marker({
    position: ubicacion,
    map: map,
  });

  marker.addListener('click', function() {
    infowindow.open(map, marker);
  });

}
</script>


    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5JVn06z1NKzHt58eCo-XXLNsvemOiXXs&libraries=places&callback=initMap"></script>


@endsection
