@extends('layouts.main')

@section('title', 'Seleccionar Cliente')

@section('content')
<div class="container">
    <h3>Seleccionar Cliente</h3>
    <form method="GET" action="{{ route('facturas.select-cliente') }}">
        <div class="form-group">
            <input 
                type="text" 
                name="search" 
                class="form-control" 
                placeholder="Buscar cliente por nombre, código o contacto" 
                value="{{ request('search') }}">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Contacto</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->codigoCliente }}</td>
                    <td>{{ $cliente->nombreCliente }}</td>
                    <td>{{ $cliente->contactoCliente }}</td>
                    <td>
                        <a href="{{ route('facturas.create', $cliente->idCliente) }}" class="btn btn-success">
                            Seleccionar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No se encontraron clientes.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $clientes->links() }} <!-- Pagination Links -->
    </div>
</div>
@endsection
