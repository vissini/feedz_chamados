@extends('adminlte::page')

@section('title', 'Criar Módulo')

@section('content_header')
    <h1>Adicionar Módulo</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
              <!-- /.box-header -->
              <!-- form start -->
              @include('_errors')
              <form role="form" method="POST" action="{{ route('modules.store') }}">
                @include('module._form')
  
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Criar Módulo</button>
                  <a href="{{ route('modules.index') }}" class="btn btn-default">Cancelar</a>
                </div>
              </form>
            </div>
            <!-- /.box -->  
          </div>
    </div>

@stop