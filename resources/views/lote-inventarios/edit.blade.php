@extends('layouts.main')

@section('title', 'Editar Lote')

@section('content')
<div class="container">
    <h4 class="mb-4">Editar Lote</h4>
    <a href="{{ route('lote-inventarios.index') }}" class="btn btn-sm btn-secondary">
        <i class="ri-arrow-left-s-line"></i> Volver a la lista
    </a>
    @include('lote-inventarios.partials.form', [
        'action' => route('lote-inventarios.update', $loteInventario->idLote),
        'method' => 'PUT',
        'loteInventario' => $loteInventario, // Pass existing data
        'buttonText' => 'Actualizar'
    ])
</div>
@endsection