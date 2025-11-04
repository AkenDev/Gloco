<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\Cliente;
use App\Models\Inventario;
use App\Models\DetalleFactura;
use App\Http\Requests\StoreFacturaRequest;
use App\Http\Requests\UpdateFacturaRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Spatie\Browsershot\Browsershot;
use App\Helpers\NumberToWords;


class FacturasController extends Controller
{   

    //This method will fetch clients and return a view with a searchable table or dropdown.
        public function selectCliente(Request $request)
    {
        // Search clients if a query is provided
        $query = $request->get('search');
        $clientes = Cliente::when($query, function ($queryBuilder) use ($query) {
            $queryBuilder->where('nombreCliente', 'like', "%{$query}%")
                ->orWhere('codigoCliente', 'like', "%{$query}%")
                ->orWhere('contactoCliente', 'like', "%{$query}%");
        })->paginate(10); // Paginated for performance

        return view('facturas.select-cliente', compact('clientes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($idCliente)
    {
        $cliente = Cliente::findOrFail($idCliente); // Ensure the client exists
        $inventarios = Inventario::select('idInventario', 'codInventario', 'descrInventario', 'unidadInventario', 'precioDolarInventario', 'precioCordInventario')->get();
    
        return view('facturas.create', compact('cliente', 'inventarios'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFacturaRequest $request)
    {
        // Wrap the entire operation in a database transaction
        DB::beginTransaction();
    
        try {
            // Extract validated data
            $validated = $request->validated();
            $detalleFacturas = $validated['detalle_facturas'];
            $clienteId = $validated['idCliente'];
    
            // Calculate totals
            $subtotal = 0;
            $totalIva = 0;
            foreach ($detalleFacturas as $detalle) {
                $subtotal += $detalle['cantidad'] * $detalle['precioUnitario'];
    
                if (!empty($detalle['aplicaIva'])) {
                    $totalIva += ($detalle['cantidad'] * $detalle['precioUnitario']) * 0.15; // 15% IVA
                }
            }
    
            $total = $subtotal + $totalIva;
    
            // Create the Factura
            $factura = Factura::create([
                'idCliente' => $clienteId,
                'fecha' => $validated['fecha'],
                'esDolar' => $validated['esDolar'],
                'totalSubtotal' => $subtotal,
                'ivaAplicado' => $totalIva,
                'fechaVence' => $request->fechaVence ?: null, // Handle null
                'tipoFactura' => $validated['tipoFactura'],
            ]);
    
            // Add Detalle_Facturas
            foreach ($detalleFacturas as $detalle) {
                // Validate stock
                $inventario = Inventario::where('codInventario', $detalle['codInventario'])->first();
                $cantidadSolicitada = $detalle['cantidad'];
    
                if ($cantidadSolicitada > $inventario->lotes->sum('pivot.stockPorLote')) {
                    throw ValidationException::withMessages([
                        'detalle_facturas' => "No hay existencias suficientes en el inventario para el producto {$detalle['codInventario']}."
                    ]);
                }
    
                // Deduct stock from available Lotes
                foreach ($inventario->lotes as $lote) {
                    if ($cantidadSolicitada <= 0) break;
    
                    $stockDisponible = $lote->pivot->stockPorLote;
                    $stockADescontar = min($stockDisponible, $cantidadSolicitada);
    
                    $lote->pivot->stockPorLote -= $stockADescontar;
                    $lote->pivot->save();
    
                    $cantidadSolicitada -= $stockADescontar;
                }
    
                // Create Detalle_Factura
                DetalleFactura::create([
                    'idFactura' => $factura->idFactura,
                    'codInventario' => $detalle['codInventario'],
                    'cantidad' => $detalle['cantidad'],
                    'precioUnitario' => $detalle['precioUnitario'],
                    'ivaUnitario' => $detalle['aplicaIva'] ? $detalle['precioUnitario'] * 0.15 : 0,
                ]);
            }
    
            // Commit transaction
            DB::commit();
    
            // Redirect to the summary page
            return redirect()->route('facturas.show', $factura->idFactura)
                             ->with('success', 'Factura creada exitosamente.');
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();
            return back()->withErrors(['error' => 'Ocurrió un error al crear la factura: ' . $e->getMessage()]);
        }
    }

    public function show(Factura $factura)
    {
        // Eager load related Cliente and DetalleFactura data
        $factura->load('cliente', 'detalles.inventario');

        // Calculate total subtotal, total IVA, and final total dynamically
        $subtotal = $factura->detalles->sum(function ($detalle) {
            return $detalle->cantidad * $detalle->precioUnitario;
        });

        $totalIva = $factura->detalles->sum('ivaUnitario');
        $total = $subtotal + $totalIva;

        // Return the view with the invoice data
        return view('facturas.show', compact('factura', 'subtotal', 'totalIva', 'total'));
    }

    public function descargarFactura($id)
    {
        $factura = Factura::with('cliente', 'detalles.inventario')->findOrFail($id);
        $montoLetras = NumberToWords::convertir($factura->totalSubtotal + $factura->ivaAplicado); // Pending function

        $html = view('facturas.invoice', compact('factura', 'montoLetras'))->render();



        Browsershot::html($html)
            ->format('Letter') // Similar to setPaper
            ->margins(0, 0, 0, 0) // Top, Right, Bottom, Left
            ->setOption('printBackground', true) // Ensures background colors/images
            ->save(storage_path("app/public/Factura-{$factura->idFactura}.pdf"));

        return response()->file(storage_path("app/public/Factura-{$factura->idFactura}.pdf"));
    }

}
