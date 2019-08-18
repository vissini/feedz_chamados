@extends('adminlte::page')

@section('title', 'Chamados')

@section('content_header')
    <h1>Lista de Chamados</h1>
@stop

@section('content')
    @include('_errors')
    <a class="btn btn-primary" href="{{ route('tickets.create') }}" style="margin-bottom: 20px;">Abrir Chamado</a>

    <form action="{{ route('tickets.index') }}" method="get" class="form-inline" style="margin-bottom: 20px;">
        <input type="hidden" name="filter" value="s">
        <div class="form-group">
            <label for="exampleInputName2">Período</label>
            <input type="date" name="opened_at_start" id="opened_at_start" value="{{ old("opened_at_start") }}">
        </div>
        <div class="form-group">
                <label for="exampleInputName2">até</label>
                <input type="date" name="opened_at_finish" id="opened_at_finish" value="{{ old("opened_at_start") }}">
            </div>
        <div class="form-group">
            <label for="exampleInputName2">Usuário</label>
            <select name="user_id" id="user_id" class="form-control">
                <option value="">Selecione o Usuário</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ (old("user_id") == $user->id ? "selected":"") }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="comapny_id">Empresa</label>
            <select name="company_id" id="company_id" class="form-control">
                <option value="">Selecione a Empresa</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ (old("company_id") == $company->id ? "selected":"") }}>{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="channel_id">Canal</label>
            <select name="channel_id" id="channel_id" class="form-control">
                <option value="">Selecione o Canal</option>
                @foreach ($channels as $channel)
                    <option value="{{ $channel->id }}" {{ (old("channel_id") == $channel->id ? "selected":"") }}>{{ $channel->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="module_id">Módulo</label>
            <select name="module_id" id="module_id" class="form-control">
                <option value="">Selecione o Módulo</option>
                @foreach ($modules as $module)
                    <option value="{{ $module->id }}" {{ (old("module_id") == $module->id ? "selected":"") }}>{{ $module->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="type_id">Tipo</label>
            <select name="type_id" id="type_id" class="form-control">
                <option value="">Selecione o Módulo</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ (old("type_id") == $type->id ? "selected":"") }}>{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-default">Filtrar</button>
    </form>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Data Abertura</th>
                <th>Usuário</th>
                <th>Empresa</th>
                <th>Canal</th>
                <th>Módulo</th>
                <th>Tipo</th>
                <th>Fechado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->opened_at_formated }}</td>
                    <td>{{ $ticket->user->name }}</td>
                    <td>{{ $ticket->company->name }}</td>
                    <td>{{ $ticket->channel->name }}</td>
                    <td>{{ $ticket->module->name }}</td>
                    <td>{{ $ticket->type->name }}</td>
                    <td>{{ $ticket->closed_formated }}</td>
                    <td style="width:240px;">
                        <a class='btn btn-warning' href=" {{ route('tickets.edit',  ['type'=>$ticket->id]) }}">Editar</a>
                        <button type="button" class='btn btn-success' data-ticket_id="{{ $ticket->id }}" data-toggle="modal" data-target="#exampleModal" >Finalizar</button>
                        <a class='btn btn-danger' href=" {{ route('tickets.destroy', ['type'=>$ticket->id]) }} " 
                            onclick="event.preventDefault(); if(confirm('Deseja apagar o Chamado')){document.getElementById('form-ticket-delete-{{ $ticket->id }}').submit();}"
                        >Deletar</a>
                        <form id="form-ticket-delete-{{ $ticket->id }}" style="display:none" action="{{ route('tickets.destroy', ['ticket'=>$ticket->id]) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8">Nenhum registro encontrado!</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Finalizar Chamado</h4>
            </div>
            <form action="{{ route('tickets.close') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="ticket_id" class="control-label">id:</label>
                        <input type="text" class="form-control" id="ticket_id" name="id">
                    </div>
                    <div class="form-group">
                        <label for="description_closed" class="control-label">Descrição Fechamento:</label>
                        <textarea class="form-control" id="description_closed" name="description_closed"></textarea>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Finalizar Chamado</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function(){
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('ticket_id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-body input').val(recipient)
        })
    }, false);
    </script>
    {{ $tickets->links() }}
@stop
