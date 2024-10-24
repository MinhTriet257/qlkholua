{{-- @if ($errors->has('name'))
<span class="error">
    {{ $errors->first('name')  }}
</span>    
@endif --}}
@extends('layout.master')
@section('content')
        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>
                    Name
                </label>            
                <input type="text" name="full_name" class="form-control">
         
            </div>
                Gender 
                <input type="radio" name="gender" value="0" checked>Nam
                <input type="radio" name="gender" value="1" >Nu
                <br>
                Số điện thoại :
                <input type="text" name="phone_number">
                <br>
                Birthdate 
                <input type="date" name="birthdate">
                <br>
                {{-- Status 
                @foreach ($arrStudentStatus as $option => $value)
                    <input type="radio" name="status" value="{{ $value }}"
                        @if ($loop->first)
                            checked
                        @endif
                    > 
                    {{-- tích cái đầu tiên --}}
                    {{-- {{ $option }}
                    <br>
                @endforeach
                <br> --}} 
                Avatar
                <input type="file" name="avarta">
                <br>
                Kho gạo 
                <select name="warehouse_id">
                    @foreach ($warehouses as $warehouse)
                        <option value="{{ $warehouse->id }}">
                            {{ $warehouse->warehouse_name }}
                        </option>
                    @endforeach
                </select>
            <br>
            <button>Them</button>
        </form>

@endsection