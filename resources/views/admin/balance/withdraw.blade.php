@extends('adminlte::page')

@section('title', 'Saque - Sistema de Saldo')

@section('content_header')
    <h1>Saque</h1>

    <ol class="breadcrumb">
    	<li><a href="">Home</a></li>
        <li><a href="">Saldo</a></li>
    	<li><a href="">Saque</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
    	<div class="box-header">
    		<h3>Novo Saque</h3>
    	</div>
    	<div class="box-body">
            
           @include('admin.includes.alerts')

    		<form method="POST" action="{{route('withdraw.store')}}">

                {!! csrf_field() !!}

                <div class="form-group">
                   <input type="text" name="value" placeholder="Valor do Saque" class="form-control"> 
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Sacar</button>
                </div>
            </form>
    	</div>
    </div>
@stop