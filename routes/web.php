<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PembelianController;
use App\Models\Barang;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix("auth")->middleware('not-auth')->group(function() {
    Route::get("/", function() {
        return redirect()->route('auth.login');
    });
    Route::get("login", [AuthController::class, "login"])->name("auth.login");
    Route::post("login", [AuthController::class, "checkLogin"])->name("auth.check_login");
});

Route::resource("barang", BarangController::class)->middleware('auth');

Route::prefix("pembelian")->middleware('auth')->group(function() {
    Route::get("/", function() {
        return redirect()->route("pembelian.index");
    });

    Route::get("index", [PembelianController::class, "index"])->name("pembelian.index");
    Route::get("create", [PembelianController::class, "index"])->name("pembelian.create");
    Route::post("/", [PembelianController::class, "index"])->name("pembelian.store");
    Route::delete("/{id}", [PembelianController::class, "index"])->name("pembelian.destroy");
});