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
        <li class="active">Sedes</li>
      </ol>
    </section>




    <section class="content container-fluid">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div id="map" style="width:100%;min-height:300px;"></div>
          </div>
        </div>
      </div>

                <div class="row">
                  <div class="col-xs-12">
                    <div class="box">
                      <div class="box-header">
                        <h3 class="box-title">Sedes</h3> <a href=""><i class="fa fa-refresh"></i></a>

                        <div class="box-tools">
                          <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                              <button type="button" class="btn btn-default" ><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body table-responsive no-padding">
                        <table class="table table-hover" >
                          <tbody><tr>
                            <th>#</th>
                            <th>Dirección</th>
                            <th>contacto</th>
                            <th>Telefono</th>
                            <th>Actividades</th>
                          </tr>
                          @if ($rows)
                            @foreach ($rows as $key)
                            <tr id="tabla_sedes">
                              <td>{{$key->id}}</td>
                              <td>{{$key->direccion}}<a href="https://maps.google.com/?q={{$key->lat}},{{$key->lng}}" target="_blank"> <i class="fa fa-map-marker"></i></td>
                              <td><a href="{{ url('sedes/'.$key->id)}}">{{$key->contacto}}</a></td>
                              <td>{{$key->telefono}}</td>
                              <td><a href="{{ url('actividades-client/create/'.$key->id)}}"><i class="fa fa-search"></i></a></td>
                            </tr>
                            @endforeach
                          @endif
                        </tbody></table>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                  </div>
                </div>
                @if ($rows)
                  {{ $rows->links() }}
                @endif
    </section>


<script>

function initMap() {

  var map = new google.maps.Map(document.getElementById('map'), {
    center: {
      lat: 4.710988599999999,
      lng: -74.0720292
    },
    zoom: 10,
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
@if ($rows)
  @foreach ($marcadores as $marcador)

  var contentString = '<p>Dirección: {{$marcador->direccion}}, <br><a href="https://maps.google.com/?q={{$marcador->lat}},{{$marcador->lng}}" target="_blank">Abrir en Google maps</a> ';

  var infowindow = new google.maps.InfoWindow({
    content: contentString
  });

  var ubicacion = {
    lat: {{$marcador->lat}},
    lng: {{$marcador->lng}}
  };

  marker = new google.maps.Marker({
    position: ubicacion,
    map: map,
  });

  marker.addListener('click', function() {
    infowindow.open(map, marker);
  });

  @endforeach
@endif
}

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5JVn06z1NKzHt58eCo-XXLNsvemOiXXs&libraries=places&callback=initMap"></script>




@endsection
