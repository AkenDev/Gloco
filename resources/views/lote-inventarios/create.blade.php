@extends('layouts.main')

@section('title', 'Añadir Lote')

@section('content')
<div class="container">
    <h4 class="mb-4">Añadir Nuevo Lote</h4>
    <a href="{{ route('lote-inventarios.index') }}" class="btn btn-sm btn-secondary">
        <i class="ri-arrow-left-s-line"></i> Volver a la lista
    </a>
    @include('lote-inventarios.partials.form', [
        'action' => route('lote-inventarios.store'),
        'method' => 'POST',
        'loteInventario' => null, // No pre-filled data
        'buttonText' => 'Guardar'
    ])
</div>
@endsection