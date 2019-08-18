@extends('adminlte::page')

@section('title', 'Editar Tipo')

@section('content_header')
    <h1>Editar Tipo</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
              <!-- /.box-header -->
              <!-- form start -->
              @include('_errors')
              <form role="form" method="POST" action="{{ route('types.update', ['type'=>$type->id]) }}">
                {{method_field('PUT')}}
                @include('type._form')
  
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Alterar Tipo</button>
                  <a href="{{ route('types.index') }}" class="btn btn-default">Cancelar</a>
                </div>
              </form>
            </div>
            <!-- /.box -->  
          </div>
    </div>

@stop