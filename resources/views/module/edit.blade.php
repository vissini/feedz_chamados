@extends('adminlte::page')

@section('title', 'Editar Módulo')

@section('content_header')
    <h1>Editar Módulo</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
              <!-- /.box-header -->
              <!-- form start -->
              @include('_errors')
              <form role="form" method="POST" action="{{ route('modules.update', ['module'=>$module->id]) }}">
                {{method_field('PUT')}}
                @include('module._form')
  
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Alterar Módulo</button>
                  <a href="{{ route('modules.index') }}" class="btn btn-default">Cancelar</a>
                </div>
              </form>
            </div>
            <!-- /.box -->  
          </div>
    </div>

@stop