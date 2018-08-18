@extends('adminlte::page')

@section('title', 'Confirmar Transferencia - Sistema de Saldo')

@section('content_header')
    <h1>Confirmar Transferencia</h1>

    <ol class="breadcrumb">
    	<li><a href="">Home</a></li>
        <li><a href="">Saldo</a></li>
    	<li><a href="">Transferir</a></li>
        <li><a href="">Confirmar</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
    	<div class="box-header">
    		<h3>Transferir Saldo (Informe o Valor)</h3>
    	</div>
    	<div class="box-body">
            
           @include('admin.includes.alerts')

           <p><h4><strong>Recebedor: </strong>{{ $sender->name }}</h4></p>
           <p><h4><strong>Seu Saldo atual: </strong>R$ {{number_format($balance->amount, 2, ',', '')}}</h4></p>
    		<form method="POST" action="{{route('transfer.store')}}">

                {!! csrf_field() !!}

                <input type="hidden" name="sender_id" value="{{ $sender->id }}">

                <div class="form-group">
                   <input type="text" name="value" placeholder="Informe o valor" class="form-control"> 
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Transferir</button>
                </div>
            </form>
    	</div>
    </div>
@stop