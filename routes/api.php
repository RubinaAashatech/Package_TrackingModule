<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReceiverController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('customers', [CustomerController::class, 'index'])->name('api.customers.index');
Route::get('customers/create', [CustomerController::class, 'create'])->name('api.customers.create');
Route::post('customers', [CustomerController::class, 'store'])->name('api.customers.store');
Route::get('customers/{customer}', [CustomerController::class, 'show'])->name('api.customers.show');
Route::get('customers/{customer}/edit', [CustomerController::class, 'edit'])->name('api.customers.edit');
Route::put('customers/{customer}', [CustomerController::class, 'update'])->name('api.customers.update');
Route::delete('customers/{customer}', [CustomerController::class, 'destroy'])->name('api.customers.destroy');

Route::get('receivers', [ReceiverController::class, 'index'])->name('api.receivers.index');
Route::get('receivers/create', [ReceiverController::class, 'create'])->name('api.receivers.create');
Route::post('receivers', [ReceiverController::class, 'store'])->name('api.receivers.store');
Route::get('receivers/{receiver}', [ReceiverController::class, 'show'])->name('api.receivers.show');
Route::get('receivers/{receiver}/edit', [ReceiverController::class, 'edit'])->name('api.receivers.edit');
Route::put('receivers/{receiver}', [ReceiverController::class, 'update'])->name('api.receivers.update');
Route::delete('receivers/{receiver}', [ReceiverController::class, 'destroy'])->name('api.receivers.destroy');