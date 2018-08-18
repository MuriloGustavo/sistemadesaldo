@extends('adminlte::page')

@section('title', 'Transferencia - Sistema de Saldo')

@section('content_header')
    <h1>Transferencia</h1>

    <ol class="breadcrumb">
    	<li><a href="">Home</a></li>
        <li><a href="">Saldo</a></li>
    	<li><a href="">Transferir</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
    	<div class="box-header">
    		<h3>Transferir Saldo (Informe o Recebedor)</h3>
    	</div>
    	<div class="box-body">
            
           @include('admin.includes.alerts')

    		<form method="POST" action="{{route('confirm.transfer')}}">

                {!! csrf_field() !!}

                <div class="form-group">
                   <input type="text" name="sender" placeholder="Informação de quem vai receber a transferencia (Nome ou E-mail)" class="form-control"> 
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Proxima Etapa</button>
                </div>
            </form>
    	</div>
    </div>
@stop