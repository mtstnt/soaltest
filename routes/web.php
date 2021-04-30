<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PembelianController;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
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
    return redirect()->route("barang.index");
});

Route::prefix("auth")->middleware('not-auth')->group(function() {
    Route::get("/", function() {
        return redirect()->route('auth.login');
    });
    
    Route::get("login", [AuthController::class, "login"])->name("auth.login");
    Route::post("login", [AuthController::class, "checkLogin"])->name("auth.check_login");
    Route::post("logout", [AuthController::class, "logout"])->name("auth.logout");
});

Route::resource("barang", BarangController::class)->middleware('auth');

Route::prefix("pembelian")->middleware('auth')->group(function() {
    Route::get("/", function() {
        return redirect()->route("pembelian.index");
    });

    Route::get("index", [PembelianController::class, "index"])->name("pembelian.index");
    Route::get("create", [PembelianController::class, "create"])->name("pembelian.create");
    Route::get("/{id}", [PembelianController::class, "show"])->name("pembelian.show");
    Route::post("/", [PembelianController::class, "store"])->name("pembelian.store");
    Route::delete("/{id}", [PembelianController::class, "destroy"])->name("pembelian.destroy");
});