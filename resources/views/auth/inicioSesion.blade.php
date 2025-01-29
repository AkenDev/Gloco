{{-- login.blade.php --}}
@extends('layouts.authmain')

@section('title', 'Inicio de Sesión')

@section('signincontent')
<div class="row no-gutters">
    <div class="col-sm-6 align-self-center">
        <div class="sign-in-from">
            <h1 class="mb-0 dark-signin">Inicio de sesión</h1>
            <p>Por favor, ingrese su usuario y contraseña para continuar.</p>

            {{-- Display Errors --}}
            <div id="error-container" class="alert alert-danger d-none">
                <ul id="error-list"></ul>
            </div>

            {{-- Login Form --}}
            <form id="loginForm" class="mt-4">
                @csrf {{-- CSRF protection is mandatory --}}
                
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control mb-0" 
                        id="email" 
                        placeholder="Correo Electrónico" 
                        required>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input 
                        type="password" 
                        name="password" 
                        class="form-control mb-0" 
                        id="password" 
                        placeholder="Contraseña" 
                        required>
                </div>

                <div class="d-inline-block w-100">
                    
                    <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                        <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                        <label class="custom-control-label" for="remember">Recordarme</label>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="btn btn-primary float-right">Iniciar sesión</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-6 text-center">
        <div class="sign-in-detail text-white">
            {{-- Optional design/image for this section --}}
        </div>
    </div>
</div>

@vite(['resources/js/login.js'])

@endsection
