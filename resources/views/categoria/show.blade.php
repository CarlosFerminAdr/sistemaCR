@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center"><strong>Consultar Categoria</strong></h1>
        <hr>
        <div class="row">
            <div class="col-sm-6 offset-3">
                <div class="list-group">
                    <h2 class="list-group-item"><strong>Categoria: </strong>{{$categoria->tipo}}</h2>
                    <h2 class="list-group-item"><strong>Descripción: </strong>{{$categoria->descripcion}}</h2>
                    <hr>
                </div>
                <br>
                    <a class="btn btn-dark float-right mt-4" href="{{route('categorias.index')}}">
                <i class="bi bi-arrow-return-left"></i> Atras</a>
            </div>
        </div>
    </div>
@endsection