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
use App\Http\Controllers\TransactionDetailController;
use App\Models\Transaction;
use Maatwebsite\Excel\Row;

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

        // latihan TO
        Route::resource('produk-titipans', ProdukTitipanController::class);
        Route::post('update-stok/{id}', [ProdukTitipanController::class, 'updateStok'])->name('produk-titipans.updateStok');


        // Transaksi
        Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');
        Route::get('transaction/index', [TransactionController::class, 'listTransaksi'])->name('transaction.data');
        Route::get('transaction/invoice/{id}', [TransactionController::class, 'nota_faktur']);


        // Export Excel
        Route::get('categories-export/', [CategoryController::class, 'export'])->name('categories-export');
        Route::get('type-export/', [TypeController::class, 'export'])->name('type-export');
        Route::get('menu-export/', [MenuController::class, 'export'])->name('menu-export');
        Route::get('customer-export/', [CustomerController::class, 'export'])->name('customer-export');
        Route::get('table-export/', [TableController::class, 'export'])->name('table-export');
        Route::get('stock-export/', [StockController::class, 'export'])->name('stock-export');
        Route::get('list-export/', [TransactionController::class, 'export'])->name('list-export');
        Route::get('produktitipans-export/', [ProdukTitipanController::class, 'export'])->name('produktitipans-export');


        // Export PDF
        Route::get('category/exportpdf', [CategoryController::class, 'exportpdf'])->name('categoires-exportPdf');
        Route::get('type/exportpdf', [TypeController::class, 'exportpdf'])->name('type-exportPdf');
        Route::get('menu/exportpdf', [MenuController::class, 'exportpdf'])->name('menu-exportPdf');
        Route::get('customer/exportpdf', [CustomerController::class, 'exportpdf'])->name('customer-exportPdf');
        Route::get('table/exportpdf', [TableController::class, 'exportpdf'])->name('table-exportPdf');
        Route::get('stock/exportpdf', [StockController::class, 'exportpdf'])->name('stock-exportPdf');
        Route::get('transaction-list/exportpdf', [TransactionController::class, 'exportpdf'])->name('transaction-list-exportPdf');


        // Import
        Route::post('categories-import/', [CategoryController::class, 'import'])->name('categories-import');
        Route::post('type-import/', [TypeController::class, 'import'])->name('type-import');
        Route::post('menu-import/', [MenuController::class, 'import'])->name('menu-import');
        Route::post('table-import/', [TableController::class, 'import'])->name('table-import');
        Route::post('stock-import/', [StockController::class, 'import'])->name('stock-import');
        Route::post('customer-import/', [CustomerController::class, 'import'])->name('customer-import');
    });
