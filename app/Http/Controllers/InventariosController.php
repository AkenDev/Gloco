<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\LoteInventario;
use App\Http\Requests\StoreInventarioRequest;
use App\Http\Requests\UpdateInventarioRequest;

class InventariosController extends Controller
{

    // Fetch shared data for forms
    private function getSharedData()
    {
        return LoteInventario::select('idLote', 'codLote', 'fechaVencimiento')->get();
    }
        
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch Inventarios with their associated Lotes
        $inventarios = Inventario::with('lotes')->paginate(10);

        // Calculate the total stock for each Inventario
        $inventarios->each(function ($inventario) {
            $inventario->totalStock = $inventario->lotes->sum('pivot.stockPorLote');
        });

        return view('inventarios.index', compact('inventarios'));
    }

    // Show the form to create a new inventario
    public function create()
    {
        $lotes = $this->getSharedData();
        // Pass the Lotes data to the view and expose it to JavaScript
        return view('inventarios.create', compact('lotes'))->with('lotesJson', $lotes->toJson());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventarioRequest $request)
    {
        // Create the Inventario
        $inventario = Inventario::create($request->validated());
    
        // Attach Lotes with stock (if provided in the request)
        if ($request->has('lotes')) {
            foreach ($request->lotes as $lote) {
                $inventario->lotes()->attach($lote['idLote'], ['stockPorLote' => $lote['stockPorLote']]);
            }
        }
    
        return redirect()->route('inventarios.index')->with('success', 'Inventario creado correctamente.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Inventario $inventario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventario $inventario)
    {
        // Fetch all Lotes for the dropdown
        $lotes = $this->getSharedData();

        // Fetch the currently assigned Lotes for the Inventario
        $assignedLoteIds = $inventario->lotes()->pluck('lote_inventarios.idLote')->toArray();

        // Load the current Lotes and their stock for this Inventario
        $loteData = $inventario->lotes()->withPivot('stockPorLote')->get();

        // Return view with all Lotes and current assignments
        return view('inventarios.edit', compact('inventario', 'lotes', 'loteData'))
            ->with('lotesJson', $lotes->toJson());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventarioRequest $request, Inventario $inventario)
    {
        // Step 1: Update the Inventario's basic details
        $inventario->update($request->validated());

        // Step 2: Sync Lotes and their stock
        if ($request->has('lotes')) {
            $syncData = [];
            foreach ($request->lotes as $loteData) {
                $syncData[$loteData['idLote']] = ['stockPorLote' => $loteData['stockPorLote']];
            }
            $inventario->lotes()->sync($syncData);
        }

        // Redirect back with success message
        return redirect()->route('inventarios.index')->with('success', 'Inventario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventario $inventario)
    {
        // Step 1: Detach all related Lotes
        $inventario->lotes()->detach();

        // Step 2: Delete the Inventario
        $inventario->delete();

        // Redirect back with success message
        return redirect()->route('inventarios.index')->with('success', 'Inventario eliminado correctamente.');
    }

    //For printing the lotes for each Inventario
    public function getLotes($id)
    {
        try {
            // Buscar el Inventario por ID
            $inventario = Inventario::findOrFail($id);
    
            // Obtener los lotes con la información de stock desde la tabla pivote
            $lotes = $inventario->lotes->map(function ($lote) {
                return [
                    'codLote' => $lote->codLote, // Código del lote
                    'articulos' => $lote->pivot->stockPorLote, // Stock desde la tabla pivote
                ];
            });
    
            // Responder con éxito en formato JSON
            return response()->json([
                'success' => true,
                'data' => $lotes,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Manejar el caso en que el Inventario no sea encontrado
            return response()->json([
                'success' => false,
                'error' => 'Inventario no encontrado.',
            ], 404);
        } catch (\Exception $e) {
            // Registrar otros errores inesperados
            \Log::error('Error obteniendo los lotes del inventario ID ' . $id . ': ' . $e->getMessage());
    
            // Responder con un mensaje genérico de error
            return response()->json([
                'success' => false,
                'error' => 'Ocurrió un error al obtener los lotes. Por favor, inténtelo de nuevo más tarde.',
            ], 500);
        }
    }
}
