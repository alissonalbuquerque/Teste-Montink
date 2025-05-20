<?php

use App\Http\Controllers\CupomController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VariantController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index']);

Route::prefix('/products')->group(function() {
    Route::get('/index', [ProductController::class, 'index'])->name('product.index');
    Route::get('/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
});

Route::prefix('/variants')->group(function() {
    Route::get('/create/{product_id}', [VariantController::class, 'create'])->name('variant.create');
    Route::post('/store', [VariantController::class, 'store'])->name('variant.store');
    Route::get('/edit/{id}', [VariantController::class, 'edit'])->name('variant.edit');
    Route::put('/update/{id}', [VariantController::class, 'update'])->name('variant.update');
    Route::delete('/delete/{id}', [VariantController::class, 'destroy'])->name('variant.delete');
});

Route::prefix('/coupons')->group(function() {
    Route::get('/index', [CupomController::class, 'index'])->name('cupom.index');
    Route::get('/create', [CupomController::class, 'create'])->name('cupom.create');
    Route::post('/store', [CupomController::class, 'store'])->name('cupom.store');

    Route::get('/edit/{id}', [CupomController::class, 'edit'])->name('cupom.edit');
    Route::put('/update/{id}', [CupomController::class, 'update'])->name('cupom.update');
    Route::delete('/delete/{id}', [CupomController::class, 'destroy'])->name('cupom.delete');
});
