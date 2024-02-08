<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/allinvoices' , [InvoiceController::class , 'getallinvoices']);
Route::get('/search' , [InvoiceController::class , 'search']);
Route::get('/create' , [InvoiceController::class , 'create']);
Route::get('/get-customers' , [CustomerController::class , 'getCustomers']);
Route::get('/get-product' , [ProductController::class , 'getProduct']);
Route::post('/addinvoice' , [InvoiceController::class , 'addinvoice']);
Route::get('/getinvoice/{id}' , [InvoiceController::class , 'getinvoice']);
