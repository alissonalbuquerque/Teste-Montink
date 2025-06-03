<?php

use App\Http\Controllers\BuyController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CepController;
use App\Http\Controllers\CupomController;
use App\Http\Controllers\FreteController;
use App\Http\Controllers\OrderController;
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
    Route::get('/search/{id}', [VariantController::class, 'findById'])->name('variant.search');
});

Route::prefix('/coupons')->group(function() {
    Route::get('/index', [CupomController::class, 'index'])->name('cupom.index');
    Route::get('/create', [CupomController::class, 'create'])->name('cupom.create');
    Route::post('/store', [CupomController::class, 'store'])->name('cupom.store');

    Route::get('/edit/{id}', [CupomController::class, 'edit'])->name('cupom.edit');
    Route::put('/update/{id}', [CupomController::class, 'update'])->name('cupom.update');
    Route::delete('/delete/{id}', [CupomController::class, 'destroy'])->name('cupom.delete');

    Route::post('/recover', [CupomController::class, 'recover'])->name('cupom.search');
});

Route::prefix('buy')->group(function() {
    Route::get('create/{product_id}', [BuyController::class, 'create'])->name('buy.create');
    Route::post('store', [BuyController::class, 'store'])->name('buy.store');
    Route::post('order', [BuyController::class, 'order'])->name('buy.order');
    Route::post('finish', [BuyController::class, 'finish'])->name('buy.finish');
});

Route::prefix('/cart')->group(function() {
    Route::get('/create', [CartController::class, 'create'])->name('cart.create');
    Route::post('/order', [CartController::class, 'order'])->name('cart.order');
});

Route::prefix('/cep')->group(function() {
    Route::get('search/{cep}', [CepController::class, 'search'])->name('cep.search');
});

Route::prefix('/frete')->group(function() {
    Route::post('/calculate', [FreteController::class, 'calculate'])->name('frete.calculate');
});

Route::prefix('/order')->group(function() {
    Route::get('/index', [OrderController::class, 'index'])->name('order.index');
});