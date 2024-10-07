<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use Illuminate\Contracts\Database\Eloquent\Builder;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private Builder $model ;
    
    public function index()
    {
        return view('warehouse.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('warehouse.store'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWarehouseRequest $request)
    {
        
        // $this->model->create($request->validated());

        // return redirect()->route('warehouses.index');
        // dd('123');
         // Xác thực dữ liệu
        $validatedData = $request->validate([
            'warehouse_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
        ]);
   
        // Tạo mới kho lúa
        Warehouses::create($validatedData);

        // Chuyển hướng hoặc trả về thông báo thành công
        return redirect()->route('warehouses.index')->with('success', 'Kho lúa đã được thêm thành công!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warehouse $warehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWarehouseRequest $request, Warehouse $warehouse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        //
    }
}
