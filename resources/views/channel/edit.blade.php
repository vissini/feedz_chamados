@extends('adminlte::page')

@section('title', 'Editar Canal')

@section('content_header')
    <h1>Editar Canal</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
              <!-- /.box-header -->
              <!-- form start -->
              @include('_errors')
              <form role="form" method="POST" action="{{ route('channels.update', ['channel'=>$channel->id]) }}">
                {{method_field('PUT')}}
                @include('channel._form')
  
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Alterar Canal</button>
                  <a href="{{ route('channels.index') }}" class="btn btn-default">Cancelar</a>
                </div>
              </form>
            </div>
            <!-- /.box -->  
          </div>
    </div>

@stop