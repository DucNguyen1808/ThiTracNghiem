<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonHocController;
use App\Http\Controllers\CauHoiController;
use App\Models\MonHoc;
Route::get('/', function () {
    $monHoc = MonHoc::all();
    
    return view('welcome',['monhoc'=>$monHoc]);
});
Route::resource('/monhoc',MonHocController::class);
Route::resource('/cauhoi',CauHoiController::class);
