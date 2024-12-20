<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//Main App Controllers
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\LoteInventariosController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\InventariosController;
use App\Http\Controllers\DetalleFactuasController;

// Import the AuthenticatedSessionController class from the App\Http\Controllers\Auth namespace
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('home');
    })->name('home');
});

// Define a route for the login page
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login') // Name this route 'login' for easy reference
    ->middleware('guest'); // Apply the 'guest' middleware to ensure only unauthenticated users can access this route

// Define a route to handle the login form submission
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest'); // Apply the 'guest' middleware to ensure only unauthenticated users can access this route

// Define a route to handle user logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout') // Name this route 'logout' for easy reference
    ->middleware('auth'); // Apply the 'auth' middleware to ensure only authenticated users can access this route

// Protect routes with 'auth' middleware
Route::middleware('auth')->group(function () {
    Route::resource('clientes', ClientesController::class);
});

// Prefix to add the clientes actions
Route::prefix('clientes')->middleware('auth')->group(function () {
    Route::resource('/', ClientesController::class)->parameters(['' => 'cliente'])->names([
        'index' => 'clientes.index',
        'create' => 'clientes.create',
        'store' => 'clientes.store',
        'show' => 'clientes.show',
        'edit' => 'clientes.edit',
        'update' => 'clientes.update',
        'destroy' => 'clientes.destroy',
    ]);
});

// Prefix to add the LoteInventarios actions
Route::prefix('lote-inventarios')->middleware('auth')->group(function () {
    Route::resource('/', LoteInventariosController::class)->parameters(['' => 'loteInventario'])->names([
        'index' => 'lote-inventarios.index',
        'create' => 'lote-inventarios.create',
        'store' => 'lote-inventarios.store',
        'show' => 'lote-inventarios.show',
        'edit' => 'lote-inventarios.edit',
        'update' => 'lote-inventarios.update',
        'destroy' => 'lote-inventarios.destroy',
    ]);
});

// Prefix to add the Facturas actions
Route::prefix('facturas')->middleware('auth')->group(function () {
    Route::resource('/', FacturasController::class)->parameters(['' => 'factura'])->names([
        'index' => 'facturas.index',
        'create' => 'facturas.create',
        'store' => 'facturas.store',
        'show' => 'facturas.show',
        'edit' => 'facturas.edit',
        'update' => 'facturas.update',
        'destroy' => 'facturas.destroy',
    ]);
});

// Prefix to add the Inventario actions
Route::prefix('inventarios')->middleware('auth')->group(function () {
    Route::resource('/', InventariosController::class)->parameters(['' => 'inventario'])->names([
        'index' => 'inventarios.index',
        'create' => 'inventarios.create',
        'store' => 'inventarios.store',
        'edit' => 'inventarios.edit',
        'update' => 'inventarios.update',
        'destroy' => 'inventarios.destroy',
    ]);
});

require __DIR__.'/auth.php';
