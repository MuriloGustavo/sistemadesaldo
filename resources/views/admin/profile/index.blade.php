@extends('adminlte::page')

@section('title', 'Perfil - Sistema de Saldo')

@section('content_header')
    <h1>Perfil</h1>

    <ol class="breadcrumb">
    	<li><a href="">Home</a></li>
        <li><a href="">Perfil</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
    	<div class="box-header">
    		<h3>Dados Cadastrais</h3>
    	</div>
    	<div class="box-body form-horizontal">
    		<div class="form-group">
				<label class="col-sm-3 control-label">Nome:</label>
				<div class="col-lg-6">
					<p class="form-control-static">{{auth()->user()->name}}</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">E-mail:</label>
				<div class="col-lg-6">
					<p class="form-control-static">{{auth()->user()->email}}</p>
				</div>
			</div>
    	</div>
    </div>
@stop