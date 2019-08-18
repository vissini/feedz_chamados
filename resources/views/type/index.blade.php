@extends('adminlte::page')

@section('title', 'Tipos')

@section('content_header')
    <h1>Lista de Tipos</h1>
@stop

@section('content')
    @include('_errors')
    <a class="btn btn-primary" href="{{ route('types.create') }}">Adicionar Tipo</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Tipo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($types as $type)
                <tr>
                    <td>{{ $type->id }}</td>
                    <td>{{ $type->name }}</td>
                    <td style="width:240px;">
                        <a class='btn btn-warning' href=" {{ route('types.edit',  ['type'=>$type->id]) }}">Editar</a>
                        <a class='btn btn-danger' href=" {{ route('types.destroy', ['type'=>$type->id]) }} " 
                            onclick="event.preventDefault(); if(confirm('Deseja apagar o Tipo')){document.getElementById('form-type-delete-{{ $type->id }}').submit();}"
                        >Deletar</a>
                        <form id="form-type-delete-{{ $type->id }}" style="display:none" action="{{ route('types.destroy', ['type'=>$type->id]) }}" method="POST">
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
    {{ $types->links() }}
@stop
