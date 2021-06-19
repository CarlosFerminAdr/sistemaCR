<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\ProductosServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductosServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all();
        $categorias = Categoria::all();
        $clientes = Cliente::all();
        return view('proservicio.index',compact('productos','categorias','clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $servicio = Servicio::create($request->all());
            foreach ($request->producto_id as $key => $value){
                $servicio->productos()->attach($value,['cantidad'=>$request['cantidades'][$key]]);
                $producto = Producto::find($value);
                $producto->stock = $producto->stock - $request['cantidades'][$key];
                $producto->save();
            }
            DB::commit();
            return $request;
        }catch(\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            echo "<br><h1>Error!!</h1>";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductosServicio  $productosServicio
     * @return \Illuminate\Http\Response
     */
    public function show(ProductosServicio $productosServicio)
    {
        $servicios = Servicio::paginate(1);
        return view('proservicio.show',compact('servicios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductosServicio  $productosServicio
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductosServicio $productosServicio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductosServicio  $productosServicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductosServicio $productosServicio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductosServicio  $productosServicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductosServicio $productosServicio)
    {
        //
    }
}
