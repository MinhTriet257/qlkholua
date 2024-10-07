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


    
        Route::resource('users', AuthController::class)->except([
          'show',
        ]);
      //  Route::resource('warehouses', WarehouseController::class);
        Route::group(['prefix' => 'warehouses', 'as' => 'warehouses.'], function() {
            Route::get('/', [WarehouseController::class, 'index'])->name('index');
            Route::get('/create', [WarehouseController::class, 'create'])->name('create');
     //     Route::get('/store', [WarehouseController::class, 'store'])->name('store');
            Route::post('/', [WarehouseController::class, 'store'])->name('store');

           //      Route::get('/index', [WarehouseController::class, 'create'])->name('create');
        });















        
        // Route::group(['prefix' => 'warehouse', 'as' => 'warehouses'], function() {
          // Route::get('/', [WarehouseController::class, 'index'])->name('index');
        // Route::get('/create', [WarehouseController::class, 'create'])->name('create');
        // Route::post('/create', [WarehouseController::class, 'store'])->name('store');
        // });
        // 
        // Route::group(['prefix' => 'warehouse', 'as' => 'warehouses.'], function() {
          //     Route::get('/', [WarehouseController::class, 'index'])->name('warehouse.index');
          //     Route::get('/create', [WarehouseController::class, 'create'])->name('create');
          //     Route::post('/warehouses', [WarehouseController::class, 'store'])->name('store');
          //  //    Route::delete('/destroy/{course}', [CourseController::class, 'destroy'])->name('destroy');
          //  //    Route::get('/edit/{course}', [CourseController::class, 'edit'])->name('edit');
        //  //    Route::put('/edit/{course}', [CourseController::class, 'update'])->name('update');
        //  });
        //  
        // Route::group([ 
//     'Middleware' => CheckLoginMiddeware::class ,
// ], function(){
     Route::get('logout', [AuthController::class, 'logout'])->name('logout');



// });
//    Route::group(['prefix' => 'user', 'as' => 'users.'], function() {
//        Route::get('/', [AuthController::class, 'index'])->name('index');
// //      Route::get('/create', [WarehouseController::class, 'create'])->name('create');
//       Route::post('/create', [WarehouseController::class, 'store'])->name('store');
//    //    Route::delete('/destroy/{course}', [CourseController::class, 'destroy'])->name('destroy');
   //    Route::get('/edit/{course}', [CourseController::class, 'edit'])->name('edit');
   //    Route::put('/edit/{course}', [CourseController::class, 'update'])->name('update');
   // });

// Route::post('/store', [WarehouseController::class, 'store'])->name('warehouses.store');