@extends('layouts.app')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Asignacion
        <small>Resumen de las Asignaciones</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Asignacion</li>
      </ol>
    </section>

<section class="content container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body no-padding">
          <div id="calendar"></div>
        </div>
      </div>
    </div>
   </div>
</section>


<script src="{{ asset('bower_components/moment/moment.js')}}"></script>
<script src="{{ asset('bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<script>

  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

        console.log(date);
    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'hoy',
        month: 'mes',
        week : 'semana',
        day  : 'dia'
      },
      //Random default events
      events    : [
        @if (Auth::user()->rol_id == 7)
          @foreach ($rows as $key)
          {
            title          : '{{$key->actividad->actividad->nombre}} - {{$key->actividad->sede->cliente->nombre}}',
             start          : '{{$key->actividad->fecha}} {{$key->actividad->hora_inicio}}',
             end            : '{{$key->actividad->fecha}} {{$key->actividad->hora_final}}',
            allDay         : false,
            url            : '{{ url('asignacion/'.$key->id)}}',
             @if ($key->act_estado_id == 1)
               backgroundColor: '#d2d6de',
               borderColor    : '#d2d6de',
             @endif
             @if ($key->act_estado_id == 2)
               backgroundColor: '#00c0ef',
               borderColor    : '#00c0ef',
             @endif
             @if ($key->act_estado_id == 3)
               backgroundColor: '#f39c12',
               borderColor    : '#f39c12',
             @endif
             @if ($key->act_estado_id == 4)
               backgroundColor: '#FF0000',
               borderColor    : '#FF0000',
             @endif
             @if ($key->act_estado_id == 5)
               backgroundColor: '#0080FF',
               borderColor    : '#0080FF',
             @endif
             @if ($key->act_estado_id == 5)
               backgroundColor: '#29088A',
               borderColor    : '#29088A',
             @endif
          },
          @endforeach
        @endif
        @if (Auth::user()->rol_id <= 2)
          @foreach ($rows as $key)
          {
            title          : '{{$key->actividad->nombre}} - {{$key->sede->cliente->nombre}}',
             start          : '{{$key->fecha}} {{$key->hora_inicio}}',
             end            : '{{$key->fecha}} {{$key->hora_final}}',
            allDay         : false,
            url            : '{{ url('actividades-client/'.$key->id)}}',
             @if ($key->act_estado_id == 1)
               backgroundColor: '#d2d6de',
               borderColor    : '#d2d6de',
             @endif
             @if ($key->act_estado_id == 2)
               backgroundColor: '#00c0ef',
               borderColor    : '#00c0ef',
             @endif
             @if ($key->act_estado_id == 3)
               backgroundColor: '#f39c12',
               borderColor    : '#f39c12',
             @endif
             @if ($key->act_estado_id == 4)
               backgroundColor: '#FF0000',
               borderColor    : '#FF0000',
             @endif
             @if ($key->act_estado_id == 5)
               backgroundColor: '#0080FF',
               borderColor    : '#0080FF',
             @endif
             @if ($key->act_estado_id == 5)
               backgroundColor: '#29088A',
               borderColor    : '#29088A',
             @endif

          },
          @endforeach
        @endif
      ],
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      }
    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })
</script>
@endsection
