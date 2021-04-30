<?php

use App\Http\Controllers\AuthController;
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

Route::prefix("auth")->group(function() {
    Route::get("/", function() {
        return redirect()->route('auth.login');
    });
    Route::get("login", [AuthController::class, "login"])->name("auth.login");
    Route::post("login", [AuthController::class, "checkLogin"])->name("auth.check_login");
});