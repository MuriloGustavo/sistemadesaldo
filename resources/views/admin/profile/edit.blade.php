@extends('adminlte::page')

@section('title', 'Editar Perfil - Sistema de Saldo')

@section('content_header')
    <h1>Editar Perfil</h1>

    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li><a href="">Editar Perfil</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
    	<div class="box-header">
    		<h3>Dados Cadastrais</h3>
    	</div>
    	<div class="box-body">
            
           @include('admin.includes.alerts')

    		<form method="POST" action="{{route('deposit.store')}}">

                {!! csrf_field() !!}

               <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" value="{{ auth()->user()->name }}" name="name" placeholder="Nome" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" value="{{ auth()->user()->email }}" name="email" placeholder="E-mail" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" name="password" placeholder="Senha" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Atualizar Dados</button>
                </div>
            </form>
    	</div>
    </div>
@stop