<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonHocController;
use App\Http\Controllers\CauHoiController;
use App\Models\MonHoc;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[LoginController::class,'showLogin'])->name('login');
Route::post('/checkLogin',[LoginController::class,'authenticate'])->name('checkLogin');

//->middleware('auth')
Route::prefix('admin')->group(function () {
    Route::resource('/monhoc', MonHocController::class);
    Route::resource('/cauhoi', CauHoiController::class);

});
