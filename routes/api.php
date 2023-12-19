<?php

use App\Http\Controllers\ActivityLog_controller;
use App\Http\Controllers\Authentication_controller;
use App\Http\Controllers\Category_controller;
use App\Http\Controllers\Product_controller;
use App\Http\Controllers\Sales_controller;
use App\Http\Controllers\Stock_controller;
use App\Http\Controllers\Transaction_controller;
use App\Http\Controllers\User_controller;
use App\Models\Category_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [Authentication_controller::class, 'login'])->name('user.login');
Route::post('/user', [User_controller::class,  'store'])->name('user.store');



// Route::post('/user', [User_controller::class,  'store'])->name('user.store');

// Route::middleware('auth:sanctum')->group(function () {
Route::post('/logout', [Authentication_controller::class, 'logout']);


Route::controller(User_controller::class)->group(function () {
    Route::get('/user',                 'index');
    Route::get('/user/{id}',            'show');
    Route::post('/name/user/{id}',      'name')->name('user.name');
    Route::post('/email/user/{id}',     'email')->name('user.email');
    Route::post('/password/user/{id}',  'password')->name('user.password');
    Route::delete('/user/{id}',         'destroy');

    // Route::get('/userIncome/{id}',      'userOverallIncome');
    // Route::get('/user-trans',           'userTrans');
    // Route::get('/user/stock',           'userStocks');
});

Route::controller(Stock_controller::class)->group(function () {
    Route::get('/stock',            'index');
    // Route::get('/stock/sum',        'sumStock');
    Route::get('/stock/user',       'userStock');
    Route::get('/stock/{id}',       'show');
    Route::put('/stock/{id}',       'update');
    Route::post('/stock',           'store');
    Route::delete('/stock/{id}',    'destroy');
});

Route::controller(Product_controller::class)->group(function () {
    Route::get('/product',            'index');
    Route::get('/product/{id}',       'show');
    Route::post('/product/{id}',       'update');
    Route::post('/product',           'store')->name('product.store');
    Route::delete('/product/{id}',    'destroy');
    Route::put('/product/img/{id}',    'image')->name('product.image');

    // Joined Tables 
    Route::get('/product/category',   'proDCategory');
    Route::get('/product/stock',      'prodStock');
});

Route::controller(Sales_controller::class)->group(function () {
    Route::get('/sales',            'index');
    Route::get('/sales/{id}',       'show');
    Route::put('/sales/{id}',       'update');
    Route::post('/sales',           'store');
    Route::delete('/sales/{id}',    'destroy');

    Route::get('/annual/{id}',            'annualSales');
});

Route::controller(Transaction_controller::class)->group(function () {
    Route::get('/transaction',            'index');
    Route::get('/transaction/{id}',       'show');
    Route::put('/transaction/{id}',       'update');
    Route::post('/transaction',           'store');
    Route::delete('/transaction/{id}',    'destroy');

    Route::get('/userTrans',             'userTrans');
    Route::get('/transSort',             'transSort');
    Route::get('/BalanceTrans',          'transBalance');
    // Route::get('/transaction/user',    'userTrans');
});

Route::controller(Category_controller::class)->group(function () {
    Route::get('/category',            'index');
    Route::get('/category/{id}',       'show');
    Route::put('/category/{id}',       'update');
    Route::post('/category',           'store');
    Route::delete('/category/{id}',    'destroy');
});

Route::controller(ActivityLog_controller::class)->group(function () {
    Route::get('/activity',            'index');
    Route::get('/activity/{id}',       'show');
    Route::put('/activity/{id}',       'update');
    Route::post('/activity',           'store');
    Route::delete('/activity/{id}',    'destroy');

    Route::get('/activity-log',       'userActivity');
});
// });






//---------------IGNORE---------------//

// Route::get('/user', [User_controller::class,  'index']);
// Route::get('/user/{id}', [User_controller::class,  'show']);
// // Route::post('/user', [User_controller::class,  'store'])->name('user.store');
// Route::post('/name/user/{id}', [User_controller::class,  'name'])->name('user.name');
// Route::post('/email/user/{id}', [User_controller::class,  'email'])->name('user.email');
// Route::post('/password/user/{id}', [User_controller::class,  'password'])->name('user.password');
// Route::delete('/user/{id}', [User_controller::class,  'destroy']);

// Route::get('/stock', [Stock_controller::class, 'index']);
// Route::get('/stock/{id}', [Stock_controller::class, 'show']);
// Route::post('/stock', [Stock_controller::class, 'store']);
// Route::delete('/stock/{id}', [Stock_controller::class, 'destroy']);