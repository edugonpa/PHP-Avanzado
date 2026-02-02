<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ApiExampleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // Listar - Todos los usuarios autenticados
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');
    
    // Crear - Todos los usuarios autenticados
    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('products.create');
    
    Route::post('/products', [ProductController::class, 'store'])
        ->name('products.store');
    
    // Editar - Todos los usuarios autenticados
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
        ->name('products.edit');
    
    Route::put('/products/{product}', [ProductController::class, 'update'])
        ->name('products.update');
    
    // Eliminar - SOLO ADMIN
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->middleware('role:admin')  // ← PROTECCIÓN ADICIONAL
        ->name('products.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('api-examples')->middleware(['auth'])->group(function () {
    //Ejemplo de reques simple
    Route::get('/get-users', [ApiExampleController::class, 'getUser'])->name('api-examples.get-users');
});