<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch all clients from the database
        $clientes = Cliente::all();

        $search = $request->input('search');

        $clientes = Cliente::when($search, function ($query, $search) {
            $query->where('codigoCliente', 'like', "%{$search}%")
                  ->orWhere('nombreCliente', 'like', "%{$search}%")
                  ->orWhere('rucCliente', 'like', "%{$search}%");
        })->paginate(10);

        // Return the clients view with data
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            // Return the create view
            return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request)
    {
        // Generate `codigoCliente` if not provided
        $codigoCliente = $request->input('codigoCliente') ?? $this->generateCodigoCliente();

        // Create a new client
        Cliente::create([
            'codigoCliente' => $codigoCliente,
            'depaCliente' => $request->depaCliente,
            'nombreCliente' => $request->nombreCliente,
            'contactoCliente' => $request->contactoCliente,
            'telCliente' => $request->telCliente,
            'rucCliente' => $request->rucCliente,
            'dirCliente' => $request->dirCliente,
        ]);

        // Redirect back with success message
        return redirect()->route('clientes.index')->with('success', 'Cliente agregado correctamente.');
    }

    /**
     * Generate the next available `codigoCliente`.
     */
    protected function generateCodigoCliente()
    {
        // Fetch the highest existing `codigoCliente`
        $lastCliente = Cliente::where('codigoCliente', 'LIKE', 'G%')
            ->orderBy('codigoCliente', 'desc')
            ->first();

        // Extract the numeric part of the code and increment it
        $lastNumber = $lastCliente ? (int)substr($lastCliente->codigoCliente, 1) : 0;
        $nextNumber = $lastNumber + 1;

        // Return the formatted code (e.g., G0001)
        return 'G' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        // Return the edit view with the client data
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        // Update the client's details
        $cliente->update($request->validated());

        // Redirect back with success message
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        // Delete the client
        $cliente->delete();

        // Redirect back with success message
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }
}
