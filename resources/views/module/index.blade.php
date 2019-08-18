@extends('adminlte::page')

@section('title', 'Módulos')

@section('content_header')
    <h1>Lista de Módulos</h1>
@stop

@section('content')
    @include('_errors')
    <a class="btn btn-primary" href="{{ route('modules.create') }}">Adicionar Módulo</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Módulo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($modules as $module)
                <tr>
                    <td>{{ $module->id }}</td>
                    <td>{{ $module->name }}</td>
                    <td style="width:240px;">
                        <a class='btn btn-warning' href=" {{ route('modules.edit',  ['module'=>$module->id]) }}">Editar</a>
                        <a class='btn btn-danger' href=" {{ route('modules.destroy', ['module'=>$module->id]) }} " 
                            onclick="event.preventDefault(); if(confirm('Deseja apagar o Módulo')){document.getElementById('form-module-delete-{{ $module->id }}').submit();}"
                        >Deletar</a>
                        <form id="form-module-delete-{{ $module->id }}" style="display:none" action="{{ route('modules.destroy', ['module'=>$module->id]) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="2">Nenhum registro encontrado!</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $modules->links() }}
@stop
