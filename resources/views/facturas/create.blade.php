@extends('layouts.main')

@section('title', 'Crear Factura')

@section('content')
<script>
    window.inventariosData = @json($inventarios);
</script>
<div class="container">
    <h3>Crear Factura para {{ $cliente->nombreCliente }}</h3>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('facturas.store') }}">
        @csrf
        <input type="hidden" name="idCliente" value="{{ $cliente->idCliente }}">

        <!-- Client Information -->
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Nombre:</strong> {{ $cliente->nombreCliente }}</p>
                <p><strong>Código:</strong> {{ $cliente->codigoCliente }}</p>
                <p><strong>Contacto:</strong> {{ $cliente->contactoCliente }}</p>
            </div>
        </div>

        <!-- Fecha -->
        <div class="form-group">
            <label for="fecha">Fecha de la Factura</label>
            <input 
                type="date" 
                name="fecha" 
                id="fecha" 
                class="form-control @error('fecha') is-invalid @enderror" 
                value="{{ old('fecha', now()->format('Y-m-d')) }}" 
                required>
            @error('fecha')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tipo de Factura -->
        <div class="form-group">
            <label for="tipoFactura">Tipo de Factura</label>
            <select 
                name="tipoFactura" 
                id="tipoFactura" 
                class="form-control @error('tipoFactura') is-invalid @enderror" 
                required>
                <option value="contado" {{ old('tipoFactura') === 'contado' ? 'selected' : '' }}>Contado</option>
                <option value="credito" {{ old('tipoFactura') === 'credito' ? 'selected' : '' }}>Crédito</option>
            </select>
            @error('tipoFactura')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Fecha de Vencimiento -->
        <div class="form-group" id="fechaVenceGroup" style="display: none;">
            <label for="fechaVence">Fecha de Vencimiento</label>
            <input 
                type="date" 
                name="fechaVence" 
                id="fechaVence" 
                class="form-control @error('fechaVence') is-invalid @enderror" 
                value="{{ old('fechaVence') }}">
            @error('fechaVence')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Selecting currency -->
        <div class="form-group">
            <label for="currency">Moneda</label>
            <select name="esDolar" id="currency" class="form-control">
                <option value="0" {{ old('esDolar', '0') === '0' ? 'selected' : '' }}>Córdobas</option>
                <option value="1" {{ old('esDolar') === '1' ? 'selected' : '' }}>Dólares</option>
            </select>
        </div>

        <!-- Search and Select Product -->
        <div class="form-group">
            <label for="searchProducto">Buscar Producto</label>
            <input type="text" id="searchProducto" class="form-control" placeholder="Buscar por código o descripción">
        </div>
        <div id="searchResults" class="list-group d-none"></div>

        <!-- Invoice Items -->
        <table class="table" id="items-table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th>Precio Unitario</th>
                    <th>IVA</th>
                    <th>Total</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach (old('detalle_facturas', []) as $index => $detalle)
                    <tr>
                        <!-- Your existing dynamic row rendering logic here -->
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="mt-3">
            <p><strong>Subtotal:</strong> <span id="subtotal">0.00</span></p>
            <p><strong>IVA Total:</strong> <span id="total-iva">0.00</span></p>
            <p><strong>Total:</strong> <span id="total">0.00</span></p>
        </div>

        <div class="col-md-6 mb-3">
            <button type="submit" class="btn btn-success">Crear Factura</button>
        </div>
    </form>
</div>


<!-- Lotes Selection Modal -->
<div class="modal fade" id="loteModal" tabindex="-1" role="dialog" aria-labelledby="loteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loteModalLabel">Seleccionar Lotes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table" id="loteTable">
                    <thead>
                        <tr>
                            <th>Código Lote</th>
                            <th>Stock Disponible</th>
                            <th>Cantidad Seleccionada</th>
                        </tr>
                    </thead>
                    <tbody id="loteTableBody">
                        <!-- Rows populated dynamically -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="saveLoteSelection">Guardar Selección</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ Vite::asset('resources/js/InventariosFactura.js') }}"></script>
@endsection
