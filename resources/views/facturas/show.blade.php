@extends('layouts.main')

@section('title', 'Detalle de Factura')

@section('content')
<div class="container">
    <h3>Factura #{{ $factura->idFactura }}</h3>

    <!-- Client Info -->
    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $factura->cliente->nombreCliente }}</p>
            <p><strong>Código:</strong> {{ $factura->cliente->codigoCliente }}</p>
            <p><strong>Contacto:</strong> {{ $factura->cliente->contactoCliente }}</p>
        </div>
    </div>

    <!-- Invoice Details -->
    <table class="table">
        <thead>
            <tr>
                <th>Cantidad</th>
                <th>Descripción</th>
                <th>Precio Unitario</th>
                <th>IVA</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($factura->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ $detalle->inventario->descrInventario }}</td>
                    <td>{{ number_format($detalle->precioUnitario, 2) }}</td>
                    <td>{{ number_format($detalle->ivaUnitario, 2) }}</td>
                    <td>{{ number_format($detalle->cantidad * $detalle->precioUnitario, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Totals -->
    <div class="mt-3">
        <p><strong>Subtotal:</strong> {{ number_format($subtotal, 2) }}</p>
        <p><strong>IVA Total:</strong> {{ number_format($totalIva, 2) }}</p>
        <p><strong>Total:</strong> {{ number_format($total, 2) }}</p>
    </div>

    <a href="{{ route('home') }}" class="btn btn-primary mt-3">Volver al Dashboard</a>
</div>
@endsection
