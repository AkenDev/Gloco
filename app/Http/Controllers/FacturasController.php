<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use App\Http\Requests\StoreFacturaRequest;
use App\Http\Requests\UpdateFacturaRequest;

class FacturasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facturas = Factura::with('cliente')->paginate(10);
        return view('facturas.index', compact('facturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('facturas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFacturaRequest $request)
    {
        // The request is already validated by StoreFacturaRequest
        Factura::create($request->validated());

        return redirect()->route('facturas.index')->with('success', 'Factura creada correctamente.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Factura $factura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factura $factura)
    {
        // Return the edit view with the factura data
        return view('facturas.edit', compact('factura'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFacturaRequest $request, Factura $factura)
    {
        // The request is already validated by UpdateFacturaRequest
        $factura->update($request->validated());

        return redirect()->route('facturas.index')->with('success', 'Factura actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factura $factura)
    {
        // Delete the client
        $factura->delete();

        // Redirect back with success message
        return redirect()->route('facturas.index')->with('success', 'Factura eliminada correctamente.');
    }
}
