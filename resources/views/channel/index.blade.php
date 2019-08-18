@extends('adminlte::page')

@section('title', 'Canais')

@section('content_header')
    <h1>Lista de Canais</h1>
@stop

@section('content')
    @include('_errors')
    <a class="btn btn-primary" href="{{ route('channels.create') }}">Adicionar Canal</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Canal</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($channels as $channel)
                <tr>
                    <td>{{ $channel->id }}</td>
                    <td>{{ $channel->name }}</td>
                    <td style="width:240px;">
                        <a class='btn btn-warning' href=" {{ route('channels.edit',  ['channel'=>$channel->id]) }}">Editar</a>
                        <a class='btn btn-danger' href=" {{ route('channels.destroy', ['channel'=>$channel->id]) }} " 
                            onclick="event.preventDefault(); if(confirm('Deseja apagar o Canal')){document.getElementById('form-channel-delete-{{ $channel->id }}').submit();}"
                        >Deletar</a>
                        <form id="form-channel-delete-{{ $channel->id }}" style="display:none" action="{{ route('channels.destroy', ['channel'=>$channel->id]) }}" method="POST">
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
    {{ $channels->links() }}
@stop
