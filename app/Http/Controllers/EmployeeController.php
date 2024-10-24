<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employes\StoreRequest;
use App\Models\Employee;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route ;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private Builder $model;
    public function __construct(){

		$this->model = (new Employee())->query();
		$routeName   = Route::currentRouteName(); 
		$arr         = explode('.', $routeName);
		$arr         = array_map('ucfirst', $arr); // 'ucfirst' hàm viết hoa chữ cái đầu 
		$title       = implode(' - ', $arr);
		View::share('title', $title);
	    }
    public function api()
    {
        return DataTables::of($this->model->with('employee'))
        ->editColumn('gender', function($object) {
            return $object->gender_name;
        })
        // ->editColumn('status', function($object) {
        //     return StudentStatusEnum::getkeyByValue($object->status);
        // })
        // ->addColumn('age', function($object) {
        //     return $object->age;
        // })
        // ->addColumn('course_name', function($object) {
        //     return $object->course->name;
        // })
        // ->addColumn('edit', function($object) {
        //     return route('students.edit', $object);
        // })
        // ->addColumn('destroy', function($object) {
        //     return route('students.destroy', $object);
        // })
        // ->filterColumn('course_name', function($query, $keyword) {
        //     $query->whereHas('course', function($q) use ($keyword){
        //         return $q->where('id', $keyword);
        //     }); // seach course_name
        // })
        // ->filterColumn('status', function($query, $keyword) {
        //     if($keyword !== '00') {
        //         $query->where('status', $keyword);              
        //     } // seach course_name xử lý backand
        // })
         
        ->addColumn('edit', function($object) {
		    return route('employees.create', $object);
		})
		->addColumn('destroy', function($object) {
		    return route('employees.destroy', $object);
		})
	
		->make(true);       
    }

    public function index()
    {
        return view('employee.index');
    }
    public function apiName(Request $request){
        return $this->model
            ->where('name','like', '%' .$request->get('q'). '%' )
            ->get([
                'id',
                'full_name',
            ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       // return view('employee.create');
       $warehouse = Warehouse::query()->get();

        return view('employee.create',[
            'warehouses' => $warehouse,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $path = Storage::disk('public')->putFile('NV_images' ,$request->file('avarta'));
        $arr = $request->validated();
        $arr['avarta'] = $path;
        $this->model->create($arr);

        return redirect()
                ->route('employees.index')
                ->with('success', 'Đã thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
