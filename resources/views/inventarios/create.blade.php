@extends('layouts.main')

@section('title', 'Añadir Inventario')

@section('content')
<div class="iq-card-header d-flex justify-content-between">
    <h4 class="card-title">Añadir Nuevo Inventario</h4>
    <a href="{{ route('inventarios.index') }}" class="btn btn-sm btn-secondary">
        <i class="ri-arrow-left-s-line"></i> Volver a la lista
    </a>
</div>

<div class="iq-card-body">
    {{-- Flash Message --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Include the Partial Form --}}
    @include('inventarios.partials.form', [
        'action' => route('inventarios.store'),
        'method' => 'POST',
        'buttonText' => 'Guardar Inventario'
    ])
</div>
@endsection
