<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;
use App\Http\Middleware\CheckLoginMiddeware;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::view('login', 'auth.login')->name('login');
Route::post('login', [AuthController::class, 'processLogin'])->name('process_login');

Route::view('register', 'auth.register')->name('register');
Route::post('register', [AuthController::class, 'processRegister'])->name('process_register');

        Route::get('warehouses', [WarehouseController::class, 'index'])->name('warehouses.index');
        Route::get('warehouses/create', [WarehouseController::class, 'create'])->name('warehouses.create');
        Route::post('warehouses/store',[WarehouseController::class, 'store'])->name('warehouses.store');
        Route::get('warehouses/geojson', [WarehouseController::class,'geojson'])->name('warehouses.geojson');
        Route::post('warehouses/destroy', [WarehouseController::class, 'destroy'])->name('warehouses.destroy');
    
        Route::resource('users', AuthController::class)->except([
          'show',
        ]);

        Route::group(['prefix' => 'employee', 'as' => 'employees.'], function() {
          Route::get('/', [EmployeeController::class, 'index'])->name('index');
          Route::get('/create', [EmployeeController::class, 'create'])->name('create');
          Route::post('/employees', [EmployeeController::class, 'store'])->name('store');
          Route::delete('/destroy/{course}', [EmployeeController::class, 'destroy'])->name('destroy');
        //   Route::get('/edit/{course}', [CourseController::class, 'edit'])->name('edit');
        //   Route::put('/edit/{course}', [CourseController::class, 'update'])->name('update');
        });
        Route::get('employees/api', [EmployeeController::class, 'api'])->name('employees.api');// viết sau sẽ ghi đè lên thằng viết trước
        Route::get('employees/api/name', [EmployeeController::class, 'apiName'])->name('employees.api.name');// viết sau sẽ ghi đè lên thằng viết trước   



      //  Route::resource('warehouses', WarehouseController::class);
    //     Route::group(['prefix' => 'warehouse', 'as' => 'warehouses.'], function() {
    //         Route::get('/', [WarehouseController::class, 'index'])->name('index');
    //         Route::get('/create', [WarehouseController::class, 'create'])->name('create');
    //  //     Route::get('/store', [WarehouseController::class, 'store'])->name('store');
    //         Route::post('/', [WarehouseController::class, 'store'])->name('store');

    //        //      Route::get('/index', [WarehouseController::class, 'create'])->name('create');
    //     });
        















        
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



