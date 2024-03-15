<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ShoppingController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', fn() => redirect()->route('dashboard.index'));
Route::get('/home', fn() => redirect()->route('dashboard.index'));

Route::middleware('auth')->group(function() {
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('sale', SaleController::class);
    Route::resource('client', ClientController::class);

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::prefix('shopping')->controller(ShoppingController::class)->group(function() {
        Route::get('cart', 'cart')->name('shopping.cart');
    });
});

Route::controller(AuthController::class)->prefix('auth')->group(function() {
    Route::middleware('guest')->group(function () {
        Route::get('login/{id?}', 'loginView')->name('auth.login.view');
        Route::post('login', 'login')->name('auth.login');
        Route::get('register', 'registerView')->name('auth.register.view');
        Route::post('register', 'register')->name('auth.register');
    });
    Route::post('logout', 'logout')->name('auth.logout');
});