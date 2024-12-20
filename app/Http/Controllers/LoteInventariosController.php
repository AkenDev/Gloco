<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoteInventario;
use App\Http\Requests\StoreLoteInventarioRequest;
use App\Http\Requests\UpdateLoteInventarioRequest;

class LoteInventariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lotes = LoteInventario::paginate(10);
        return view('lote-inventarios.index', compact('lotes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         // Return the create view
        return view('lote-inventarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoteInventarioRequest $request)
    {
        // The request is already validated by StoreLoteInventarioRequest
        LoteInventario::create($request->validated());

        return redirect()->route('lote-inventarios.index')->with('success', 'Lote creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LoteInventario $loteInventario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoteInventario $loteInventario)
    {
        return view('lote-inventarios.edit', compact('loteInventario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreLoteInventarioRequest $request, LoteInventario $loteInventario)
    {
        // The request is already validated by UpdateLoteInventarioRequest
        $loteInventario->update($request->validated());

        return redirect()->route('lote-inventarios.index')->with('success', 'Lote actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoteInventario $loteInventario)
    {
        // Delete the lote
        $loteInventario->delete();

        // Redirect back with success message
         return redirect()->route('lote-inventarios.index')->with('success', 'Lote eliminado correctamente.');
    }
}
