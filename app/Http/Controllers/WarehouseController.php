<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private Builder $model ;
    // public function _construct(){

    //     $this->model = new Warehouse();

    // }
    public function index()
    {
        return view('warehouse.index');


    }
    // Hàm trả về GeoJSON (dành cho API)
    public function geojson()
    {
        $warehouses = Warehouse::all();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => []
        ];
        foreach ($warehouses as $warehouse) {
            $geojson['features'][] = [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        $warehouse->longitude,
                        $warehouse->latitude
                    ],
                ],
                'properties' => [
                    'name' => $warehouse->warehouse_name,
                    'address' => $warehouse->address, // Địa chỉ từ CSDL
                    'image' => $warehouse->images,
  
                ],
            ];
        }
        return response()->json($geojson);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      // return view('warehouse.store'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWarehouseRequest $request)
    {

        $path = Storage::disk('public')->putFile('KL_images', $request->file('images'));
        $arr = $request->validated();
        $arr['images'] = $path;
        
        Warehouse::create($arr);
        return redirect()
            ->route('warehouses.index')
            ->with('success', 'Đã thêm thành công');
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
