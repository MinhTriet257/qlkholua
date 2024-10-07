@extends('layout.master')
@push('css')
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.6/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/date-1.5.3/fc-5.0.1/fh-4.0.1/r-3.0.3/rg-1.5.0/sc-2.4.3/sb-1.8.0/sl-2.0.5/datatables.min.css" rel="stylesheet">
    {{-- cái link nay dể đây vô file master datatable --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- <script src='https://api.mapbox.com/mapbox-gl-js/v3.7.0/mapbox-gl.js'></script> --}}
    <link href='https://api.mapbox.com/mapbox-gl-js/v3.7.0/mapbox-gl.css' rel='stylesheet' />
@endpush
@section('content')
    <div class="card">
        <div class="card-body ">

            
           
            <div id='map' style='width: 100%; height: 550px;'>                
            </div>

        </div>
    </div>
@endsection
@push('js')
    {{-- đẩy vào javascript     --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    {{-- <script 
    src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.6/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/date-1.5.3/fc-5.0.1/fh-4.0.1/r-3.0.3/rg-1.5.0/sc-2.4.3/sb-1.8.0/sl-2.0.5/datatables.min.js"></script>   
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>  --}} 
    {{-- link slect2 --}} 
           <script src='https://api.mapbox.com/mapbox-gl-js/v3.7.0/mapbox-gl.js'></script>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoidnVraGExIiwiYSI6ImNtMXJob2g4eTA5eDcyc3MzMTFlMDdzcWIifQ.lF4KYoQPb0s_ry11QpSjNw';
        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/streets-v12', // style URL
            center: [105.1087191, 9.9717099], // starting position [lng, lat]
            zoom: 7, // starting zoom
            hash: true
        });       
    </script>
    <script>
    data = {
    "type": "FeatureCollection",
    "features": [
        {
            "type": "Feature",
            "geometry": {
                "type": "Point",
                "coordinates": [105.14428952400856, 9.916456607112663]
            },
            "properties": {
                "name": "Trường Đại Học Kiên Giang"
            }
        }
    ]
    }
    map.on('load', (e) => {
    map.addSource('university-src', {
        type: 'geojson', // Sửa 'seojson' thành 'geojson'
        data: data
        });
    map.addLayer({
        'id': 'university-location',
        'type': 'circle',
        'source': 'university-src',
        'paint': {
            'circle-radius': 10, // Đảm bảo đây là số
            'circle-color': 'green' // Sử dụng 'circle-color' để chỉ định màu
            }
        });
    });

    // Hiển thị form khi click vào bản đồ
    map.on('click', (e) => {
        const coordinates = e.lngLat;
        const formContainer = document.getElementById('form-container');
        formContainer.style.display = 'block';
        //window.clickCoordinates = coordinates; // Lưu tọa độ

                // Cập nhật tọa độ vào form
        document.getElementById('longitude').value = coordinates.lng;
        document.getElementById('latitude').value = coordinates.lat;
    });
 
    // map.on('click', (e) => {
    // const coordinates = e.lngLat;
    // const formContainer = document.getElementById('form-container');
    
    // // Hiển thị form-container
    // formContainer.style.display = 'block';

    // // Gửi AJAX request để tải nội dung form
    // fetch('{{ route('warehouses.create') }}')
    //     .then(response => response.text())
    //     .then(html => {
    //         formContainer.innerHTML = html;  // Chèn nội dung form vào div
    //         // Cập nhật tọa độ vào form sau khi tải xong
    //         document.getElementById('longitude').value = coordinates.lng;
    //         document.getElementById('latitude').value = coordinates.lat;
    //     })
    //     .catch(error => {
    //         console.error('Error loading form:', error);
    //     });
    // });


  </script>
@endpush