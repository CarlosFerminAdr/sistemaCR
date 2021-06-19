@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="container-fluid mt-5">
            <h1 class="text-center"><strong>HISTORIAL</strong></h1>
            <hr>
        </div>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Servicio</th>
                    <th>Cliente</th>
                    <th>Articulos</th>
                    <th>Total</th>
                    <th colspan="2" >Operaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($servicios as $e)
                    <tr>
                        <th>{{$e->id}}</th>
                        <th>{{$e->categoria->tipo}}</th>
                        <th>{{$e->cliente->nombre}}</th>
                        <th>{{$e->cantidad}}</th>
                        <th>{{$e->costo_total}}</th>
                        <th><a class="btn btn-primary" href="#">
                        <i class="bi bi-exclamation-lg"></i></a></th>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$servicios->links()}}
    </div>
@endsection