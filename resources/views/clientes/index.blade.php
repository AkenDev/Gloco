{{-- cliente.index.blade.php --}}
@extends('layouts.main')

@section('title', 'Clientes')

@section('content')
<div class="iq-card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Clientes</h4>
    </div>
    <form method="GET" action="{{ route('clientes.index') }}" class="d-flex">
        <input 
            type="text" 
            name="search" 
            class="form-control form-control-sm" 
            placeholder="Buscar cliente..." 
            value="{{ old('search', $search ?? '') }}"
        />
        <button type="submit" class="btn btn-primary btn-sm ml-2">Buscar</button>
    </form>
    @if(request('search'))
    <div class="alert alert-info mt-2">
        Mostrando resultados para: <strong>{{ request('search') }}</strong>
    </div>
    @endif
    <button class="btn btn-primary" onclick="window.location='{{ route('clientes.create') }}'">
        <i class="ri-add-fill"></i> <span class="pl-1">Añadir nuevo cliente</span>
    </button>
</div>
<div class="iq-card-body">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div id="table" class="table-editable">
        <table class="table table-bordered table-responsive-md table-striped text-center">
            <thead>
                <tr>
                    <th>Código Cliente</th>
                    <th>Nombre</th>
                    <th>RUC</th>
                    <th>Contacto</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Departamento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->codigoCliente }}</td>
                    <td>{{ $cliente->nombreCliente }}</td>
                    <td>{{ $cliente->rucCliente }}</td>
                    <td>{{ $cliente->contactoCliente }}</td>
                    <td>{{ $cliente->telCliente }}</td>
                    <td>{{ $cliente->dirCliente }}</td>
                    <td>{{ $cliente->depaCliente }}</td>
                    <td>
                        <a href="{{ route('clientes.edit', $cliente->idCliente) }}" class="btn iq-bg-warning btn-rounded btn-sm">
                            Editar
                        </a>
                        <form action="{{ route('clientes.destroy', $cliente->idCliente) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro que deseas eliminar este cliente?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn iq-bg-danger btn-rounded btn-sm my-0">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">No hay clientes registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $clientes->links() }}
        </div>
    </div>
</div>
@endsection