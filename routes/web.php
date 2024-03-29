<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProdukTitipanController;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('types', TypeController::class);
        Route::resource('employees', EmployeeController::class);
        Route::resource('menus', MenuController::class);
        Route::resource('stocks', StockController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('tables', TableController::class);
        Route::resource('users', UserController::class);
        Route::resource('orders', OrderController::class);

        Route::resource('produk-titipans', ProdukTitipanController::class);
        Route::post('update-stok/{id}', [ProdukTitipanController::class, 'updateStok'])->name('produk-titipans.updateStok');

        Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');
        Route::get('transaction/invoice/{id}', [TransactionController::class, 'nota_faktur']);

        // Export & import
        Route::get('produktitipans-export/', [ProdukTitipanController::class, 'export'])->name('produktitipans-export');
    });
