<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonHocController;
use App\Http\Controllers\CauHoiController;
use App\Http\Controllers\ChiTietDeThiController;
use App\Http\Controllers\ChitietnhomController;
use App\Http\Controllers\DeThiController;
use App\Http\Controllers\GiaoDeThiController;
use App\Http\Controllers\NhomController;
use App\Http\Controllers\test;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDeKiemTraConTroller;
use App\Models\ChiTietDeThi;
use App\Models\ChiTietNhom;
use App\Models\GiaoDeThi;
use App\Models\MonHoc;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/checkLogin', [LoginController::class, 'authenticate'])->name('checkLogin');


Route::prefix('admin')->middleware('auth')->middleware('isAdmin')->group(function () {
    Route::resource('/monhoc', MonHocController::class);
    Route::resource('/cauhoi', CauHoiController::class);

    Route::resource('/nhom', NhomController::class);
    Route::get('/nhom/{id}/adduser', [NhomController::class, 'adduser'])->name('nhom.adduser');
    Route::post('/chitietnhom/store', [ChitietnhomController::class, 'store'])->name('chitietnhom.store');
    Route::delete('/chitietnhom/{id}', [ChitietnhomController::class, 'destroy'])->name('chitietnhom.destroy');

    Route::resource('/user', UserController::class);
    Route::resource('/dethi', DeThiController::class);
    Route::get('/dethi/{id}/addch', [ChiTietDeThiController::class, 'create'])->name('dethi.addcauhoi');
    Route::get('/dethi/{id}/xemdiem', [DeThiController::class, 'xemdiem'])->name('dethi.xemdiem');

    Route::post('/chitietdethi/store', [ChiTietDeThiController::class, 'store'])->name('ChiTietDeThi.store');
    Route::delete('/chitietdethi/{id}', [ChiTietDeThiController::class, 'destroy'])->name('ChiTietDeThi.destroy');

    Route::post('/giaodethi/store', [GiaoDeThiController::class, 'store'])->name('giaodethi.store');
    Route::delete('/giaodethi/{id}', [GiaoDeThiController::class, 'destroy'])->name('giaodethi.destroy');
});
Route::prefix('account')->middleware('auth')->name('account.')->group(function () {
    Route::get('/',[UserController::class, 'show'])->name('show');
    Route::put('/{id}',[UserController::class, 'capnhathoso'])->name('capnhathoso');
    Route::put('doimatkhau/{id}',[UserController::class, 'doimatkhau'])->name('doimatkhau');
});
Route::prefix('user')->middleware('auth')->name('user.')->group(function () {
    Route::get('/dekiemtra',[UserDeKiemTraConTroller::class,'index'])->name('dekiemtra');
    Route::get('/dekiemtra/{id}',[UserDeKiemTraConTroller::class,'show'])->name('dekiemtra.show');
    Route::get('/dekiemtra/lamkiemtra/{id}',[UserDeKiemTraConTroller::class,'lamkiemtra'])->name('dekiemtra.lamkiemtra');
    Route::post('/dekiemtra/store', [UserDeKiemTraConTroller::class, 'store'])->name('dekiemtra.store');


});

