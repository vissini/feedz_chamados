@extends('adminlte::page')

@section('title', 'Editar Chamado')

@section('content_header')
    <h1>Editar Chamado</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
              <!-- /.box-header -->
              <!-- form start -->
              @include('_errors')
              <form role="form" method="POST" action="{{ route('tickets.update', ['ticket'=>$ticket->id]) }}">
                {{method_field('PUT')}}
                <div class="box-body">
                    {{ csrf_field() }}
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="comapny_id">Empresa</label>
                            <select name="company_id" id="company_id" class="form-control">
                                <option value="">Selecione a Empresa</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" {{ (old("company_id",$ticket->company->id) == $company->id ? "selected":"") }}>{{ $company->name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="module_id">Módulo</label>
                            <select name="module_id" id="module_id" class="form-control">
                                <option value="">Selecione o Módulo</option>
                                @foreach ($modules as $module)
                                    <option value="{{ $module->id }}" {{ (old("module_id",$ticket->module->id) == $module->id ? "selected":"") }}>{{ $module->name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="channel_id">Canal</label>
                            <select name="channel_id" id="channel_id" class="form-control">
                                <option value="">Selecione o Canal</option>
                                @foreach ($channels as $channel)
                                    <option value="{{ $channel->id }}" {{ (old("channel_id",$ticket->channel->id) == $channel->id ? "selected":"") }}>{{ $channel->name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="type_id">Tipo</label>
                            <select name="type_id" id="type_id" class="form-control">
                                <option value="">Selecione o Tipo</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" {{ (old("type_id",$ticket->type->id) == $type->id ? "selected":"") }} >{{ $type->name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="description">Descrição</label>
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description', $ticket->description) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
  
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Alterar Chamado</button>
                  <a href="{{ route('tickets.index') }}" class="btn btn-default">Cancelar</a>
                </div>
              </form>
            </div>
            <!-- /.box -->  
          </div>
    </div>

@stop