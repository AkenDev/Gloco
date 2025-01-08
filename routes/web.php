<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
    $paths = ['/dashboard', '/', '/index'];

    foreach ($paths as $path) {
        Route::get($path, function () {
            return view('home');
        });
    }

    // Set the name for one of the routes (optional)
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
    ->middleware('guest')
    ->name('login'); // Ensure the route name remains consistent

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

// Prefix to add the Inventario actions
Route::prefix('inventarios')->middleware('auth')->group(function () {
    // Resource routes for Inventarios
    Route::resource('/', InventariosController::class)->parameters(['' => 'inventario'])->names([
        'index' => 'inventarios.index',
        'create' => 'inventarios.create',
        'store' => 'inventarios.store',
        'edit' => 'inventarios.edit',
        'update' => 'inventarios.update',
        'destroy' => 'inventarios.destroy',
    ]);

});

// Prefix to add the Facturas actions
Route::prefix('facturas')->middleware('auth')->group(function () {
    // Custom route for selecting a client
    Route::get('/select-cliente', [FacturasController::class, 'selectCliente'])->name('facturas.select-cliente');
    
    // Route to create a new factura
    Route::get('/create/{idCliente}', [FacturasController::class, 'create'])->name('facturas.create');
    
    // Route to store a new factura
    Route::post('/', [FacturasController::class, 'store'])->name('facturas.store');

    // Route to show the summary of the created factura
    Route::get('/{factura}', [FacturasController::class, 'show'])->name('facturas.show');
});

Route::post('/debug-factura', function (Request $request) {
    dd($request->all());
})->name('debug.factura');



require __DIR__.'/auth.php';
