@extends('layouts.main')

@section('title', 'Inventarios')

@section('content')
<div class="iq-card-header d-flex justify-content-between">
    <h4 class="card-title">Lista de Inventarios</h4>
    <a href="{{ route('inventarios.create') }}" class="btn btn-sm iq-bg-success">
        <i class="ri-add-fill"></i> <span class="pl-1">Añadir Inventario</span>
    </a>
</div>

<div class="iq-card-body">
    {{-- Flash Message --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Inventario Table --}}
    <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Código</th>
                <th>Proveedor</th>
                <th>Descripción</th>
                <th>Unidad</th>
                <th>Precio (USD)</th>
                <th>Precio (C$)</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($inventarios as $inventario)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $inventario->codInventario }}</td>
                <td>{{ $inventario->codProveedor }}</td>
                <td>{{ $inventario->descrInventario }}</td>
                <td>{{ $inventario->unidadInventario }}</td>
                <td>{{ $inventario->precioDolarInventario }}</td>
                <td>{{ $inventario->precioCordInventario }}</td>
                <td>
                    <button class="btn btn-primary view-lotes-btn" data-id="{{ $inventario->idInventario }}" data-name="{{ $inventario->codInventario }}">
                        {{ $inventario->totalStock ?? '' }}
                    </button>
                </td>
                <td>
                    <a href="{{ route('inventarios.edit', $inventario->idInventario) }}" class="btn iq-bg-warning btn-sm">Editar</a>
                    <form action="{{ route('inventarios.destroy', $inventario->idInventario) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este inventario?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn iq-bg-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="11" class="text-center">No hay inventarios registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination Links --}}
    <div class="mt-3">
        {{ $inventarios->links() }}
    </div>
</div>

<div class="modal fade" id="loteModal" tabindex="-1" aria-labelledby="loteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loteModalLabel">Lotes por Inventario</h5>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Código del lote</th>
                            <th>Artículos</th>
                        </tr>
                    </thead>
                    <tbody id="loteTableBody">
                        <!-- Data will be populated here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="{{ Vite::asset('resources/js/getLotesForInventario.js') }}"></script>
@endsection
