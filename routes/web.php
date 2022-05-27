<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetailController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[DetailController::class, 'index']);

Route::post('store',[DetailController::class, 'store'])->name('store');
Route::post('import',[DetailController::class, 'import'])->name('import');
Route::get('export',[DetailController::class, 'export'])->name('export');


