<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;
use App\Http\Middleware\CheckLoginMiddeware;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::view('login', 'auth.login')->name('login');
Route::post('login', [AuthController::class, 'processLogin'])->name('process_login');

Route::view('register', 'auth.register')->name('register');
Route::post('register', [AuthController::class, 'processRegister'])->name('process_register');


        Route::group(['prefix' => 'users', 'as' => 'user.'], function() {
           Route::get('/', [UserController::class, 'index'])->name('index');
        //    Route::get('/create', [CourseController::class, 'create'])->name('create');
        //    Route::post('/create', [CourseController::class, 'store'])->name('store');
        //    Route::delete('/destroy/{course}', [CourseController::class, 'destroy'])->name('destroy');
        //    Route::get('/edit/{course}', [CourseController::class, 'edit'])->name('edit');
        //    Route::put('/edit/{course}', [CourseController::class, 'update'])->name('update');
        });

        Route::group(['prefix' => 'warehouses', 'as' => 'warehouse.'], function() {
            Route::get('/', [WarehouseController::class, 'index'])->name('index');
            Route::get('/create', [WarehouseController::class, 'create'])->name('create');
            Route::post('/create', [WarehouseController::class, 'store'])->name('store');
         //    Route::delete('/destroy/{course}', [CourseController::class, 'destroy'])->name('destroy');
         //    Route::get('/edit/{course}', [CourseController::class, 'edit'])->name('edit');
         //    Route::put('/edit/{course}', [CourseController::class, 'update'])->name('update');
         });
Route::group([ 
    'Middleware' => CheckLoginMiddeware::class ,
], function(){
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

 

});