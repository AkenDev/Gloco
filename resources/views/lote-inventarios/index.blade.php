@extends('layouts.main')

@section('title', 'Lote Inventarios')

@section('content')
<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Lote Inventarios</h4>
    </div>
    <a href="{{ route('lote-inventarios.create') }}" class="btn btn-primary">Añadir Lote</a>
</div>
<div class="iq-card-body">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Número Lote</th>
                <th>Fecha de Vencimiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($lotes as $lote)
                <tr>
                    <td>{{ $lote->codLote }}</td>
                    <td>{{ $lote->fechaVencimiento }}</td>
                    <td>
                        <a href="{{ route('lote-inventarios.edit', $lote->idLote) }}" class="btn iq-bg-warning btn-rounded btn-sm">Editar</a>
                        <form action="{{ route('lote-inventarios.destroy', $lote->idLote) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este lote?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn iq-bg-danger btn-rounded btn-sm my-0">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No hay lotes registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-3">
        {{ $lotes->links() }}
    </div>
</div>
@endsection