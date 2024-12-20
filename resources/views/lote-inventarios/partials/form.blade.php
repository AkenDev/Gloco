<form method="POST" action="{{ $action }}">
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    <div class="form-row">
        <!-- Lote Code -->
        <div class="col-md-6 mb-3">
            <label for="codLote">Código de Lote</label>
            <input 
                type="text" 
                class="form-control @error('codLote') is-invalid @enderror" 
                id="codLote" 
                name="codLote" 
                value="{{ old('codLote', $loteInventario->codLote ?? '') }}" 
                placeholder="Ingrese un código único para el lote" 
                required>
            @error('codLote')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Expiration Date -->
        <div class="col-md-6 mb-3">
            <label for="fechaVencimiento">Fecha de Vencimiento</label>
            <input 
                type="date" 
                class="form-control @error('fechaVencimiento') is-invalid @enderror" 
                id="fechaVencimiento" 
                name="fechaVencimiento" 
                value="{{ old('fechaVencimiento', $loteInventario->fechaVencimiento ?? '') }}" 
                required>
            @error('fechaVencimiento')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-primary" type="submit">{{ $buttonText }}</button>
    </div>
</form>