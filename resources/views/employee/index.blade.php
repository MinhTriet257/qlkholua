@extends('layout.master')
@push('css')
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.6/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/date-1.5.3/fc-5.0.1/fh-4.0.1/r-3.0.3/rg-1.5.0/sc-2.4.3/sb-1.8.0/sl-2.0.5/datatables.min.css" rel="stylesheet">
    {{-- cái link nay dể đây vô file master datatable --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="card">

        <div class="card-body ">
            <a class="btn btn-success" href=" {{ route('employees.create') }} ">
                Thêm
            </a>
            <div class="form-group">
                <select id="select-course-name"></select>
            </div>
            <div class="form-group">
                <select id="select-status" class="form-control">
                    <option value="00">
                        Tất cả
                    </option>  
                    {{-- chọn lựa cái chỗ đi học á --}}
                    {{-- @foreach ($arrStudentStatus as $option => $value)
                        <option value="{{ $value  }}">
                            {{ $option }}
                        </option>
                    @endforeach --}}
                </select>
            </div>
            <table class="table table-striped" id="table-index">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Giới Tính</th>
                        <th>Năm Sinh</th>
                        <th>SĐT</th>
                        <th>Hình Ảnh</th>
                        <th>Kho Lúa</th>
                        <th>Sửa</th>
                        <th>Xoá</th>
                    </tr>
                </thead>          
            </table>        
        </div>
    </div>
@endsection
@push('js')
    {{-- đẩy vào javascript     --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script 
    src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.6/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/date-1.5.3/fc-5.0.1/fh-4.0.1/r-3.0.3/rg-1.5.0/sc-2.4.3/sb-1.8.0/sl-2.0.5/datatables.min.js"></script>   
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> 
    {{-- link slect2 --}}
    <script>
        $(function () {
            $("#select-course-name").select2({
                ajax: {
                    url: "{{ route('employees.api.name') }}",
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function (data, params) {
            
                        return {
                            // ajax slect2
                            results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                                };
                            })
                        };
                    },
                    // cache: true
                },
                placeholder: 'Search for a Name'
                // minimumInputLength: 1
            });
            let buttonCommon = {
                    exportOptions: {
                        columns: ':visible :not(.not-export)'
                    }
                };
            let table = $('#table-index').DataTable({
                dom: 'Blfrtip' ,
                select: true,
                buttons: [
                    $.extend(true, {}, buttonCommon, {
                        extend: 'copyHtml5',
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'csvHtml5',
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'excelHtml5',
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'pdfHtml5',
                    }),
                    $.extend(true, {}, buttonCommon, {
                        extend: 'print',
                    }),
                        'colvis'
                    ],
                processing: true,
                serverSide: true,
                ajax: '{!! route('employees.api') !!}',
                columnDefs:[
                    { className: "not-export", "target": [ 3 ] }
                ],  
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'full_name', name: 'name'},
                    {data: 'gender', name: 'gender'},
                    {data: 'birthdate', name: 'birthdate'},
                    {data: 'phone_number', name: 'phone_number'},
                    { 
                        data: 'avarta',
                        target: 5,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            if (!data) {
                                return '';
                            }
                            // return `<img src="{{ public_path() }}/${data}">`;
                            return `<img src="/storage/${data}" style="width: 50px; height: 50px; object-fit: cover;">`;
                            }
                        },
                    {data: 'warehouse_id', name: 'warehouse_id'},
                    { 
                        data: 'edit',
                        target: 3,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return `<a class="btn btn-primary" href="${data}">
                                Edit
                                </a>`;
                            }
                        },
                    {
                        data: 'destroy',
                        target: 4,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {                       
                            return `<form action="${data}" method="POST"> 
                                    @csrf
                                    @method('DELETE')
                                    <button class=" btn-delete btn btn-danger" type='button'> Delete</button>    
                                </form>
                            `;
                        }
                    }
                ]
            });

            // $('#select-course-name').change( function () {
            //     table.columns(6).search($(this).val()).draw();    
            // }); // này của tìm kim tên lớp

            // $('#select-status').change( function () {
            //     let value = $(this).val();
            //     table.columns(4).search(value).draw();   
            //     // if(value === '00'){
            //     //     table
            //     //         .columns(4)
            //     //         .search( '' )
            //     //         .draw();
            //     // }else{
            //     //     table.columns(4).search(this.value).draw();    
            //     // }

            //     // đoạn này là sử lý trường hợp ki chọn đi học xong 
            //     // chọn lại tất cả thì lại k load đc này là sử lý trong fontand               
            // }); // lọc chỗ đi học hay nghĩ học đồ á

            $(document).on('click', '.btn-delete', function() {
                let form = $(this).parents('form');
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    DataType: 'json',
                    data: form.serialize(),
                    success:function() {
                        console.log("success");
                        table.draw();                  
                    },
                    error: function () {
                        console.log("error");
                    }
                });
            });  
        });
    </script>

@endpush