@extends('layout.master')
@push('css')
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.6/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/date-1.5.3/fc-5.0.1/fh-4.0.1/r-3.0.3/rg-1.5.0/sc-2.4.3/sb-1.8.0/sl-2.0.5/datatables.min.css" rel="stylesheet">
    {{-- cái link nay dể đây vô file master datatable --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- <script src='https://api.mapbox.com/mapbox-gl-js/v3.7.0/mapbox-gl.js'></script> --}}
    <link href='https://api.mapbox.com/mapbox-gl-js/v3.7.0/mapbox-gl.css' rel='stylesheet' />
    <link href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="card">
        <div class="card-body ">



            <!-- Div chứa form sẽ được tải qua AJAX -->
            <div class="form-group" id="form-container" style="display: none;"  >
                <form action="{{ route('warehouses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="warehouse_name">Tên Kho Lúa:</label>
                    <input type="text" name="warehouse_name" required><br>

                    <label for="address">ĐC Kho Lúa:</label>
                    <input type="text" name="address" required><br>

                    <label for="images">Hình Ảnh</label>
                    <input type="file" name="images" required><br>

                    <label for="longitude">Kinh Độ</label>
                    <input type="text" id="longitude" name="longitude" readonly><br><br>
                    
                    <label for="latitude">Vĩ Độ:</label>
                    <input type="text" id="latitude" name="latitude" readonly><br><br>

                    <!-- Các trường khác của form -->
                    <button type="submit">Thêm</button>
                </form>         
            </div>
           
            <div id='map' style='width: 100%; height: 550px;'>  


            </div>

        </div>
    </div>
@endsection
@push('js')
    {{-- đẩy vào javascript     --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script 
    src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.6/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/date-1.5.3/fc-5.0.1/fh-4.0.1/r-3.0.3/rg-1.5.0/sc-2.4.3/sb-1.8.0/sl-2.0.5/datatables.min.js"></script>   
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>  --}}
    {{-- link slect2 --}} 
           <script src='https://api.mapbox.com/mapbox-gl-js/v3.7.0/mapbox-gl.js'></script>
           <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
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

    // URL API mới
    const apiUrl = 'warehouses/geojson';
    let markers = []; // Mảng lưu trữ tất cả các marker và tên kho
    
    map.on('load', () => {
        fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            map.addSource('warehouse-src', {
                type: 'geojson',
                data: data
            });
            map.addLayer({
                'id': 'warehouse-name',
                'type': 'symbol',
                'source': 'warehouse-src',
                'layout': {
                    'text-field': ['get', 'name'], // Hiển thị tên kho bên cạnh biểu tượng
                    'text-size': 12,// Kích thước của icon
                    'text-offset': [0, 1.5],// Khoảng cách giữa icon và text                    
                },
                'paint': {
                    'text-color':'#BB0000'
                 }
            });
            // Duyệt qua từng feature trong GeoJSON
            data.features.forEach((feature) => {
                // Lấy kinh độ và vĩ độ từ dữ liệu GeoJSON
                const [longitude, latitude] = feature.geometry.coordinates;
                
                // Tạo marker
                const marker = new mapboxgl.Marker({color:'#FF0000'})
                    .setLngLat([longitude, latitude])  // Vị trí của marker từ GeoJSON
                    .addTo(map);  // Thêm marker vào bản đồ


            // Tạo popup và gắn vào marker
            const popup = new mapboxgl.Popup({ offset: 35 }) // Tạo popup với khoảng cách từ marker
                .setHTML(`
                    <div>
                        <h4>${feature.properties.name || 'Chưa có tên'}</h4>
                        <p>Địa chỉ: ${feature.properties.address || 'Chưa có địa chỉ'}</p>
                        <img src="/storage/${feature.properties.image || 'default.jpg'}" 
                                alt="${feature.properties.name}"
                                style="width: 100%; height: 100px; object-fit: cover; margin-top: 10px;">
                        <p>Kinh độ: ${longitude}</p>
                        <p>Vĩ độ: ${latitude}</p>
                        
                    </div>                    
                `); // Thêm nội dung popup

            // Gắn sự kiện click cho marker để hiện popup
            marker.setPopup(popup);

            // Lưu thông tin marker và tên vào mảng
            markers.push({ marker, name, coordinates: [longitude, latitude] });
            // // // Khi click vào marker, hiển thị popup và ẩn form nếu nó đang mở
            marker.getElement().addEventListener('click', (e) => {
                e.stopPropagation(); // Ngăn sự kiện click lan ra ngoài
                popup.addTo(map); // Hiển thị popup
                document.getElementById('form-container').style.display = 'none'; // Ẩn form thêm
            });   
           });
        })
        .catch(error => 
            {console.error('Error loading data:', error);
        });

         // Hiển thị form khi click vào bản đồ
    map.on('click', (e) => {
         // Lấy kinh độ và vĩ độ từ vị trí click
        const longitude = e.lngLat.lng;
        const latitude = e.lngLat.lat;

        // Hiển thị form thêm với kinh độ và vĩ độ từ vị trí click
        document.getElementById('form-container').style.display = 'block';
        document.getElementById('longitude').value = longitude;
        document.getElementById('latitude').value = latitude;
    });
    });

        // Thêm điều khiển tìm kiếm (Geocoder)
    const geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        mapboxgl: mapboxgl, // Cần truyền mapboxgl vào để liên kết với bản đồ
        placeholder: 'Tìm kiếm kho lúa...', // Văn bản gợi ý cho ô tìm kiếm
        zoom: 15, // Độ phóng to của bản đồ khi chọn kết quả
        marker: false // Không tự động thêm marker vào kết quả tìm kiếm
    });

    // Thêm thanh tìm kiếm vào map
    map.addControl(geocoder);


    // Xử lý khi người dùng chọn một kết quả từ thanh tìm kiếm Geocoder
    geocoder.on('result', (e) => {
        const searchTerm = e.result.text.toLowerCase(); // Lấy từ khóa tìm kiếm

        // Tìm kiếm trong các marker dựa trên tên kho lúa
   //     const found = markers.find(item => item.name.toLowerCase().includes(searchTerm));
        // Tìm kiếm trong các marker dựa trên tên kho lúa
    const found = markers.find(item => removeVietnameseTones(item.name.toLowerCase()).includes(removeVietnameseTones(searchTerm)));

        if (found) {
            // Zoom vào vị trí của marker và mở popup
            map.flyTo({
                center: found.coordinates,
                zoom: 15
            });

            found.marker.getPopup().addTo(map); // Hiển thị popup của marker tìm thấy
        } else {
            console.log("Không tìm thấy kho lúa tương ứng.");
        }
    });

  </script>

  <script>
      function removeVietnameseTones(str) {
    var map = {
        'a': 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
        'e': 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'i': 'í|ì|ỉ|ĩ|ị',
        'o': 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'u': 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'y': 'ý|ỳ|ỷ|ỹ|ỵ',
        'd': 'đ',
    };
    for (var letter in map) {
        var re = new RegExp(map[letter], 'g');
        str = str.replace(re, letter);
    }
    return str;
}
  </script>
@endpush