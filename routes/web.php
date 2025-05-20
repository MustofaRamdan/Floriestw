<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PembayaranController;

Route::post('/daftar/submit',[AuthController::class, 'registrasi'])->name('registrasi');

Route::get('/login', [AuthController::class, 'masuk'])->name('login');
Route::get('/daftar', [AuthController::class, 'daftar'])->name('daftar');
Route::get('/', [AuthController::class, 'landing'])->name('landing');

Route::post('/login/submit', [AuthController::class, 'login'])->name('login.submit');

Route::middleware(['auth', AuthMiddleware::class . ':user'])->group(function(){
    Route::get('/user', [UserController::class, 'home'])->name('user.home');
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add.to.cart');
    Route::delete('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('remove.from.cart');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('view.cart');
    Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout.form');
    Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::post('/midtrans/notification', [CheckoutController::class, 'handleNotification'])->name('midtrans.notification');
    Route::get('/payment/success', [CheckoutController::class, 'success'])->name('payment.success');
    Route::post('/cart/update-quantity/{id}', [CartController::class, 'updateQuantity'])->name('cart.update.quantity');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
    Route::post('/logout/user', [AuthController::class, 'logout'])->name('logout.user');
    Route::get('/search', [UserController::class, 'index'])->name('buket.bunga');
    Route::get('/status-pembayaran', [StatusController::class, 'view'])->name('status.pembayaran');
    Route::get('/checkout/retry/{order_id}', [CheckoutController::class, 'retryPayment'])->name('checkout.retry');
});
Route::middleware(['auth', AuthMiddleware::class . ':admin'])->group(function(){
    Route::get('/admin', [AdminController::class, 'home'])->name('admin.home');
    Route::post('/admin/tambah-user', [AdminController::class, 'tambah_user'])->name('tambah.user');
    Route::get('/admin/edit-user/{id}', [AdminController::class, 'editUser'])->name('edit.user');
    Route::post('/admin/edit-user/{id}', [AdminController::class, 'edit_user'])->name('update.user');
    Route::post('/admin', [AdminController::class, 'tambahBunga'])->name('tambah.bunga');
    Route::get('/admin/edit-bunga/{id}', [AdminController::class, 'editBunga'])->name('edit.bunga');
    Route::post('/admin/edit-bunga/{id}', [AdminController::class, 'updateBunga'])->name('update.bunga');
    Route::post('/admin/delete-bunga/{id}', [AdminController::class, 'deleteBunga'])->name('delete.bunga');
    Route::post('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('delete.user');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
