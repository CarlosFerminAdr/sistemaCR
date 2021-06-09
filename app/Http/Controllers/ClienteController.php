<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestCliente;
use App\Models\Cliente;
use Illuminate\Http\Request;

/**
 * Class ClienteController
 * @package App\Http\Controllers
 */
class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::paginate(5);
        return view('cliente.index',compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestCliente $request)
    {
        Cliente::create($request->all());
        return redirect('clientes')->with('mensaje','Cliente agregado con exito!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return view('cliente.show',compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('cliente.edit',compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(RequestCliente $request, Cliente $cliente)
    {
        $datos = request()->except(['_token','_method']);
        Cliente::find($cliente->id)->update($datos);
        return redirect('clientes')->with('mensaje','Cliente actualizado con exito!!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect('clientes')->with('mensaje','Cliente eliminado con exito!!');
    }
}
