@extends('layouts.main')

@section('title', 'Facturas')

@section('content')
<div class="iq-card-header d-flex justify-content-between">
    <h4 class="card-title">Facturas</h4>
    <a href="{{ route('facturas.create') }}" class="btn btn-primary">Añadir Factura</a>
</div>
<div class="iq-card-body">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Moneda</th>
                <th>Subtotal</th>
                <th>IVA</th>
                <th>Fecha de Vencimiento</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($facturas as $factura)
                <tr>
                    <td>{{ $factura->idFactura }}</td>
                    <td>{{ $factura->cliente->nombreCliente }}</td>
                    <td>{{ $factura->fecha }}</td>
                    <td>{{ $factura->esDolar ? 'USD' : 'Córdoba' }}</td>
                    <td>{{ $factura->totalSubtotal }}</td>
                    <td>{{ $factura->ivaAplicado }}</td>
                    <td>{{ $factura->fechaVence }}</td>
                    <td>{{ $factura->tipoFactura }}</td>
                    <td>
                        <a href="{{ route('facturas.edit', $factura->idFactura) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('facturas.destroy', $factura->idFactura) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No hay facturas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-3">
        {{ $facturas->links() }}
    </div>
</div>
@endsection