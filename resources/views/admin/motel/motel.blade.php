@section('title'){{'Quản lí nhà trọ'}} @endsection
    @include('layout.header_admin')
    <div class="container-fluid">
       <div class="row contain">
        @include('layout.sidebar_admin')
        <div class="col-xs-9">
            <div style="display:flex;justify-content: space-between">
                <button>
                    <a href="{{route('admin.motel.add')}}">Thêm Nhà Trọ</a>
                </button>
                <div class="row">
                      
                </div>

            </div>
                <table class="table" border="1" id = "customers" style="width:100%">
                   <thead>
                        <tr>
                            <th>STT</th>
                            <th>Quận</th>
                            <th>Phường</th>
                            <th>Ảnh</th>
                            <th>Tên nhà trọ</th>
                            <th>Địa chỉ</th>
                            <th>Ngày tạo</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                   </thead>
                </table>

            @if(session('success'))
            <div class="alert alert-success alert-with-icon" data-notify="container">
                <div class="container">
                    <div class="alert-wrapper">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="nc-icon nc-simple-remove"></i>
                        </button>
                        <div class="message"><i class="nc-icon nc-bell-55"></i> Thêm Thành Công</div>
                    </div>
                </div>
            </div>
            @endif
          </div>
       </div>
    </div>
@push('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.4/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sl-1.4.0/datatables.min.css"/>
<script src="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.4/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sl-1.4.0/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        let motels_table = $('#customers').DataTable({
            processing: true,
            serverSide: true,
            select:true, 
            ajax: '{!! route('admin.motel.api') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'district_id', name: 'district_id' },
                { data: 'ward_id', name: 'ward_id' },
                { data: 'img', name: 'img' },
                { data: 'MotelName', name: 'MotelName' },
                { data: 'Address', name: 'Address' },
                { data: 'created_at', name: 'created_at'},
                {
                  data:'edit',
                  targets:7,
                  orderable:true,
                  searchable:true,
                  render:function(data,type,row,meta){
                    console.log(data);
                        return `<a href="${data}" class="btn btn-success bg-success">Sửa</a>`;
                    }
                },
                {
                    data:'delete',
                    targets:8,
                    orderable:true,
                    searchable:true,
                    render:function(data,type,row,meta){
                        return `<form action="${data}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="if (!confirm('Bạn có muốn xóa bài viết không?')) { return false }" id="delete-button">Xóa</button>
                        </form>`;
                    }
                    
                }
            ]
        });
        motels_table.on( 'draw.dt', function () {
            var PageInfo = $('#customers').DataTable().page.info();
            let i = 1;
            motels_table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                    cell.innerHTML = i + 1 + PageInfo.start;
                } );
            } );
    });
</script>
