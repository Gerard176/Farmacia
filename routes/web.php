<?php

use App\Exceptions\NotFoundHttpException;
use App\Models\PurchaseOrder;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ExceptionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/about', function () {
    return 'Acerca de nosotros';
});

// Route::get('/user/{id}', function ($id) {
//     return 'ID de usuario: ' . $id;
// });     

// Route::get('/contacto', function () {
// return 'Página de contacto';
// })->name('contacto');

// Route::get('/user/{id}', function ($id) {
// return 'ID de usuario: ' . $id;
// })->where('id', '[0-9]{3}');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::resource('products', ProductController::class);
    Route::get('cambioestadoProduct', [ProductController::class, 'cambioestadoProduct'])->name('cambioestadoProduct');

    Route::resource('suppliers', SupplierController::class);
    Route::get('cambioestadoSupplier', [SupplierController::class, 'cambioestadoSupplier'])->name('cambioestadoSupplier');

    Route::resource('purchaseOrders', PurchaseOrderController::class);
    Route::get('cambioestadoPurchaseOrder', [PurchaseOrderController::class, 'cambioestadoPurchaseOrder'])->name('cambioestadoPurchaseOrder');
    Route::get('downloadPdf', [PurchaseOrderController::class, 'downloadPdf'])->name('downloadPdf');


});
// Route::get('errors',[ExceptionController::class, 'index']);
// Route::resource('products', ProductController::class);
