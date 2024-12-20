<form method="POST" action="{{ $action }}">
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    <div class="form-row">
        <!-- Client Code -->
        <div class="col-md-6 mb-3">
            <label for="codigoCliente">Código de Cliente</label>
            <input 
                type="text" 
                class="form-control @error('codigoCliente') is-invalid @enderror" 
                id="codigoCliente" 
                name="codigoCliente" 
                value="{{ old('codigoCliente', $cliente->codigoCliente ?? '') }}" 
                placeholder="Dejar en blanco para generar automáticamente">
            @error('codigoCliente')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Department -->
        <div class="col-md-6 mb-3">
            <label for="depaCliente">Departamento</label>
            <input 
                type="text" 
                class="form-control @error('depaCliente') is-invalid @enderror" 
                id="depaCliente" 
                name="depaCliente" 
                value="{{ old('depaCliente', $cliente->depaCliente ?? '') }}" 
                required>
            @error('depaCliente')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Name -->
        <div class="col-md-6 mb-3">
            <label for="nombreCliente">Nombre</label>
            <input 
                type="text" 
                class="form-control @error('nombreCliente') is-invalid @enderror" 
                id="nombreCliente" 
                name="nombreCliente" 
                value="{{ old('nombreCliente', $cliente->nombreCliente ?? '') }}" 
                required>
            @error('nombreCliente')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Contact -->
        <div class="col-md-6 mb-3">
            <label for="contactoCliente">Contacto</label>
            <input 
                type="text" 
                class="form-control @error('contactoCliente') is-invalid @enderror" 
                id="contactoCliente" 
                name="contactoCliente" 
                value="{{ old('contactoCliente', $cliente->contactoCliente ?? '') }}" 
                required>
            @error('contactoCliente')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Phone -->
        <div class="col-md-6 mb-3">
            <label for="telCliente">Teléfono</label>
            <input 
                type="text" 
                class="form-control @error('telCliente') is-invalid @enderror" 
                id="telCliente" 
                name="telCliente" 
                value="{{ old('telCliente', $cliente->telCliente ?? '') }}" 
                required>
            @error('telCliente')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- RUC -->
        <div class="col-md-6 mb-3">
            <label for="rucCliente">RUC</label>
            <input 
                type="text" 
                class="form-control @error('rucCliente') is-invalid @enderror" 
                id="rucCliente" 
                name="rucCliente" 
                value="{{ old('rucCliente', $cliente->rucCliente ?? '') }}" 
                required>
            @error('rucCliente')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Address -->
        <div class="col-md-12 mb-3">
            <label for="dirCliente">Dirección</label>
            <textarea 
                class="form-control @error('dirCliente') is-invalid @enderror" 
                id="dirCliente" 
                name="dirCliente" 
                rows="3" 
                required>{{ old('dirCliente', $cliente->dirCliente ?? '') }}</textarea>
            @error('dirCliente')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-primary" type="submit">{{ $buttonText }}</button>
    </div>
</form>