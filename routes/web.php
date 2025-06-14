<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/map', function () {
    return view('map');
})->name('map');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['web'])->group(function () { // Используем middleware 'web' для сессий
    // Маршруты для корзины
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add'); // Добавление товара в корзину
    Route::patch('/cart/{itemKey}', [CartController::class, 'update'])->name('cart.update'); // Обновление количества (по itemKey)
    Route::delete('/cart/remove/{itemKey}', [CartController::class, 'remove'])->name('cart.remove'); // Удаление товара (по itemKey)
    Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count'); // Получение количества товаров (для AJAX)
});

// Добавляем маршрут для страницы каталога
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');

// Динамический маршрут для отдельного товара по его SLUG с использованием Route Model Binding
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product.show');

require __DIR__.'/auth.php';