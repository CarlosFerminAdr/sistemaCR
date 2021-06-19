@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center"><strong>PRO SERVICIOS</strong></h1>
        <hr>
        <div clas="row">
            <div class="col">
            <a class="btn btn-primary float-right" href="{{route('proservicio.show',1)}}"><i class="bi bi-plus-lg"></i> Ver</a><br><br>
            </div>
        </div>
        <form action="{{route('proservicio.store')}}" method="POST">
            @csrf
            <div class="row mt-3">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header">
                            Ingresa Productos
                        </div>
                        <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Producto:</label>
                                            <select name="nombre" id="nombre" class="form-control" onchange="coloca_precio()">
                                                <option value="0">-seleccione-</option>
                                                @foreach ($productos as $p)
                                                    <option precio="{{$p->precio}}" value="{{$p->id}}">{{$p->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label for="precio" class="form-label">Precio:</label>
                                            <input type="text" name="precio" id="precio" value="0" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="mb-3">
                                            <label for="cantidad_producto" class="form-label">Cantidad:</label>
                                            <input type="number" name="cantidad_producto" id="cantidad_producto" value="0" class="form-control">
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" onclick="agregarProducto()" class="btn btn-success float-right mt-4">
                                            <i class="bi bi-cart2"></i>
                                        </button>
                                    </div>
                                </div>

                            <br>
                            <table class="table table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Subtotal</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="tabProductos">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header">
                            Captura Servicio
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <label for="categoria_id" class="form-label">Servicio:</label>
                                    <select name="categoria_id" id="categoria_id" class="form-control">
                                        <option value="0">-seleccione-</option>
                                        @foreach ($categorias as $s)
                                            <option value="{{$s->id}}">{{$s->tipo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label for="cliente_id" class="form-label">Cliente:</label>
                                    <select name="cliente_id" id="cliente_id" class="form-control">
                                        <option value="0">-seleccione-</option>
                                        @foreach ($clientes as $c)
                                            <option value="{{$c->id}}">{{$c->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label for="cantidad" class="form-label">Cantidad:</label>
                                    <input type="number" name="cantidad" id="cantidad" class="form-control">
                                </div>
                                <div class="col-sm-7">
                                    <label for="costo_total" class="form-label">Costo Total:</label>
                                    <input type="text" name="costo_total" id="costo_total" class="form-control" readonly>
                                </div>
                            </div>
                            <br>
                        </div>
                        <button class="btn btn-success float-right mt-2" type="submit">Enviar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('Scripts')
    <script>
        function coloca_precio(){
            let precio = $('#nombre option:selected').attr('precio');
            $('#precio').val(precio);
        }

        function agregarProducto(){
            let producto_id = $("#nombre option:selected").val();
            let producto_tex = $("#nombre option:selected").text();
            let cantidad = $("#cantidad_producto").val();
            let precio = $("#precio").val();
            $("#cantidad_producto").val(0);
            if (cantidad >0 && precio >0){
                $("#tabProductos").append(`
                    <tr id="tr-${producto_id}">
                        <td>
                            <input type="hidden" name="producto_id[]" value="${producto_id}"/>
                            <input type="hidden" name="cantidades[]" value="${cantidad}"/>
                            ${producto_tex}
                        </td>
                        <td>${cantidad}</td>
                        <td>${precio}</td>
                        <td>${parseInt(precio)*parseInt(cantidad)}</td>
                        <td>
                            <button type="button" onclick="eliminarProducto(${producto_id},${parseInt(precio)*parseInt(cantidad)})" class="btn btn-danger">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </td>
                    </tr>
                `);
                let carrito = $("#costo_total").val() || 0;
                $("#costo_total").val(parseInt(carrito)+parseInt(precio)*(parseInt(cantidad)));
            }else{
                alert("Ingrese Cantidad y/o Precio validos!!");
            }
        }
        function eliminarProducto(id,subtotal){
            $("#tr-"+id).remove();
            let carrito = $("#costo_total").val() || 0;
                $("#costo_total").val(parseInt(carrito)-subtotal);
        }
    </script>
@endsection