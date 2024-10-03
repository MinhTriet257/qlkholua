@extends('layout.master')

@section('content')
    
    <div id="form-container" style="display: none;">
        <form id="rice-storage-form" action="{{ route('warehouses.store')}}" method="POST">
            @csrf
            <label for="name">Tên Kho Lúa:</label>
            <input type="text" name="warehouse_name" required>
            <br>
            <label for="name">ĐC Kho Lúa:</label>
            <input type="text" name="address" required>
            <br>
            <label for="longitude">Kinh độ:</label>
            <input type="text" name="longitude" readonly>
            <br>  
            <label for="latitude">Vĩ độ:</label>
            <input type="text" name="latitude" readonly>
            <br>
            <button type="submit">Thêm Kho Lúa</button>
        </form>
    </div>

@endsection