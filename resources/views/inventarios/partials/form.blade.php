<form method="POST" action="{{ $action }}">
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif
        <script>
            window.lotesData = @json($lotesJson);
        </script>
    <div class="form-row">
        <!-- Código de Inventario -->
        <div class="col-md-6 mb-3">
            <label for="codInventario">Código de Inventario</label>
            <input 
                type="text" 
                class="form-control @error('codInventario') is-invalid @enderror" 
                id="codInventario" 
                name="codInventario" 
                value="{{ old('codInventario', $inventario->codInventario ?? '') }}" 
                required>
            @error('codInventario')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Código de Proveedor -->
        <div class="col-md-6 mb-3">
            <label for="codProveedor">Código de Proveedor</label>
            <input 
                type="text" 
                class="form-control @error('codProveedor') is-invalid @enderror" 
                id="codProveedor" 
                name="codProveedor" 
                value="{{ old('codProveedor', $inventario->codProveedor ?? '') }}" 
                required>
            @error('codProveedor')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Descripción -->
        <div class="col-md-12 mb-3">
            <label for="descrInventario">Descripción</label>
            <input 
                type="text" 
                class="form-control @error('descrInventario') is-invalid @enderror" 
                id="descrInventario" 
                name="descrInventario" 
                value="{{ old('descrInventario', $inventario->descrInventario ?? '') }}" 
                required>
            @error('descrInventario')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Unidad de Inventario -->
        <div class="col-md-6 mb-3">
            <label for="unidadInventario">Unidad</label>
            <input 
                type="text" 
                class="form-control @error('unidadInventario') is-invalid @enderror" 
                id="unidadInventario" 
                name="unidadInventario" 
                value="{{ old('unidadInventario', $inventario->unidadInventario ?? '') }}" 
                required>
            @error('unidadInventario')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Precio en Dólares -->
        <div class="col-md-6 mb-3">
            <label for="precioDolarInventario">Precio (USD)</label>
            <input 
                type="number" 
                step="0.01" 
                class="form-control @error('precioDolarInventario') is-invalid @enderror" 
                id="precioDolarInventario" 
                name="precioDolarInventario" 
                value="{{ old('precioDolarInventario', $inventario->precioDolarInventario ?? '') }}" 
                required>
            @error('precioDolarInventario')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Precio en Córdobas -->
        <div class="col-md-6 mb-3">
            <label for="precioCordInventario">Precio (C$)</label>
            <input 
                type="number" 
                step="0.01" 
                class="form-control @error('precioCordInventario') is-invalid @enderror" 
                id="precioCordInventario" 
                name="precioCordInventario" 
                value="{{ old('precioCordInventario', $inventario->precioCordInventario ?? '') }}" 
                required>
            @error('precioCordInventario')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Total Stock -->
        <div class="col-md-6 mb-3">
            <label for="stockInventario">Total Stock</label>
            <input
                type="number"
                class="form-control"
                id="stockInventario"
                name="stockInventario"
                value="{{ isset($loteData) ? $loteData->sum('pivot.stockPorLote') : 0 }}"
                disabled>
        </div>

        <!-- Lote Section -->
        <div class="col-md-6 mb-3">
            <label for="lote-section">Lotes y Stock</label>
            <div id="lote-section">
                <!-- Existing Lotes -->
                @isset($loteData)
                    @if ($loteData->isNotEmpty())
                        @foreach ($loteData as $index => $lote)
                            <div class="lote-row d-flex align-items-center mb-2">
                                <!-- Lote Dropdown -->
                                <select name="lotes[{{ $index }}][idLote]" class="form-control lote-select mr-2">
                                    <option value="">Seleccione un lote...</option>
                                    @foreach ($lotes as $loteOption)
                                        <option value="{{ $loteOption->idLote }}" 
                                            data-fecha-vencimiento="{{ $loteOption->fechaVencimiento }}"
                                            {{ $loteOption->idLote == $lote->idLote ? 'selected' : '' }}>
                                            {{ $loteOption->codLote }}
                                        </option>
                                    @endforeach
                                </select>
                                <!-- Stock Input -->
                                <input type="number" 
                                    name="lotes[{{ $index }}][stockPorLote]" 
                                    class="form-control lote-stock mr-2" 
                                    placeholder="Stock"
                                    value="{{ $lote->pivot->stockPorLote }}">
                                <!-- Remove Button -->
                                <button type="button" class="btn btn-danger remove-lote-row mr-2">Eliminar</button>
                                <!-- Fecha Vencimiento Label -->
                                <span class="fecha-vencimiento-label text-muted small">
                                    Fecha de Vencimiento: {{ $lote->fechaVencimiento }}
                                </span>
                            </div>
                        @endforeach
                    @endif
                @endisset
            </div>
            <!-- Add Row Button -->
            <button type="button" id="add-lote-row" class="btn btn-primary mt-3">Añadir Lote</button>
        </div>
  

    <!-- Submit Button -->
    <div class="col-md-6 mb-3">
        <button class="btn dark-icon btn-primary btn-block" type="submit">{{ $buttonText }}</button>
    </div>
</form>

@section('scripts')
    @vite(['resources/js/LotesSelection.js'])
@endsection

