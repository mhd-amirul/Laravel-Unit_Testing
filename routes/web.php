<?php

use App\Http\Controllers\V2\AppProductController;
use Illuminate\Support\Facades\Route;

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
// V1
include(base_path("routes/V1/route.php"));

Route::get('product', [AppProductController::class, "product"]);
