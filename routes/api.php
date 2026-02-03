<?php

use App\Http\Controllers\Api\ProductosController;
use Illuminate\Support\Facades\Route;

Route::apiResource('productos', ProductosController::class);