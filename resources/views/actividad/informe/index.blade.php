@extends('layouts.app')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Informe
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Nivel</a></li>
        <li class="active">Informe</li>
      </ol>
    </section>



    <section class="content container-fluid">

      @if(session()->has('message'))
         <div class="alert alert-success alert-dismissible">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
           <h4><i class="icon fa fa-check"></i> Realizado!</h4>
           {{session()->get('message')}}
         </div>
      @endif

      @if(session()->has('error'))
         <div class="alert alert-danger alert-dismissible">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
           {{session()->get('error')}}
         </div>
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

      <div class="col-xs-6">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Consultar programación realizada de los clientes</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            {!! Form::open(['url' => 'informe/intermediarioexcel', 'method' => 'post']) !!}
            <div role="form">
              <!-- text input -->

                <div class="form-group {{ $errors->has('intermediario') ? ' has-error' : '' }}">
                  <label>Intermediario</label>
                  <select class="form-control" name="intermediario" value="{{ old('intermediario') }}" required>
                    <option value="">..Selecionar</option>
                    @foreach ($intermediarios as $intermediario)
                    <option value="{{$intermediario->id}}">{{$intermediario->nombre}}</option>,
                    @endforeach
                  </select>
                </div>

              <div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
                <label>Rango de fecha</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right reservation" id="reservation" name='fecha' value="{{ old('fecha') }}">
                </div>
              </div>

            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-success" ><i class="fa fa-file-excel-o"></i> Descargar</button>
          </div>

          <!-- /.box-body -->
        </div>
      </div>
{!! Form::close() !!}



<div class="col-xs-6">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Horas trabajadas por profesor</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      {!! Form::open(['url' => 'informe/profesorexcel', 'method' => 'post']) !!}
      <div role="form">
        <!-- text input -->

          <div class="form-group {{ $errors->has('profesor') ? ' has-error' : '' }}">
            <label>Profesor</label>
            <select class="form-control" name="profesor" value="{{ old('profesor') }}" required>
              <option value="">..Selecionar</option>
              @foreach ($profesores as $profesor)
              <option value="{{$profesor->id}}">{{$profesor->name}}</option>,
              @endforeach
            </select>
          </div>

        <div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
          <label>Rango de fecha</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right reservation" id="reservation2" name='fecha' value="{{ old('fecha') }}">
          </div>
        </div>

      </div>
    </div>
    <div class="box-footer">
      <button type="submit" class="btn btn-success" ><i class="fa fa-file-excel-o"></i> Descargar</button>
    </div>

    <!-- /.box-body -->
  </div>
</div>
{!! Form::close() !!}


<div class="col-xs-6">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Generar PDF (demora en generase)</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      {!! Form::open(['url' => 'informe/clientepdf', 'method' => 'post']) !!}
      <div role="form">
        <!-- text input -->

          <div class="form-group {{ $errors->has('cliente') ? ' has-error' : '' }}">
            <label>Cliente</label>
            <select class="form-control" name="cliente" value="{{ old('cliente') }}" required>
              <option value="">..Selecionar</option>
              @foreach ($clientes as $cliente)
              <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>,
              @endforeach
            </select>
          </div>

        <div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
          <label>Rango de fecha</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right reservation" id="reservation2" name='fecha' value="{{ old('fecha') }}">
          </div>
        </div>

      </div>
    </div>
    <div class="box-footer">
      <button type="submit" class="btn btn-danger" ><i class="fa fa-file-pdf-o"></i> Descargar</button>
    </div>

    <!-- /.box-body -->
  </div>
</div>
{!! Form::close() !!}

    </section>





@endsection
