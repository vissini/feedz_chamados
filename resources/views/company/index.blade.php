@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
    <h1>Lista de Empresas</h1>
@stop

@section('content')
    @include('_errors')
    <a class="btn btn-primary" href="{{ route('companies.create') }}">Adicionar Empresa</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Empresa</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($companies as $company)
                <tr>
                    <td>{{ $company->id }}</td>
                    <td>{{ $company->name }}</td>
                    <td style="width:240px;">
                        <a class='btn btn-warning' href=" {{ route('companies.edit',  ['company'=>$company->id]) }}">Editar</a>
                        <a class='btn btn-danger' href=" {{ route('companies.destroy', ['company'=>$company->id]) }} " 
                            onclick="event.preventDefault(); if(confirm('Deseja apagar a Empresa')){document.getElementById('form-category-delete-{{ $company->id }}').submit();}"
                        >Deletar</a>
                        <form id="form-category-delete-{{ $company->id }}" style="display:none" action="{{ route('companies.destroy', ['category'=>$company->id]) }}" method="POST">
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
@stop
