@extends('layouts.main')

@section('title', 'Editar Cliente')

@section('content')
<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Editar Cliente</h4>
        <a href="{{ route('clientes.index') }}" class="btn btn-sm btn-secondary">
            <i class="ri-arrow-left-s-line"></i> Volver a la lista
        </a>
    </div>
</div>
<div class="iq-card-body">
    @include('clientes.partials.form', [
        'action' => route('clientes.update', $cliente->idCliente),
        'method' => 'PUT',
        'cliente' => $cliente,
        'buttonText' => 'Actualizar Cliente',
    ])
</div>
@endsection