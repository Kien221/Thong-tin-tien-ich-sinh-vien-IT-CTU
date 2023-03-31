@section('title'){{'Quản lí bài đăng'}} @endsection
    @include('layout.header_admin')
    <div class="container-fluid">
        <div class="row contain">
            @include('layout.sidebar_admin')
           <div class="col-xs-9">
                <button>
                    <a href="{{route('admin.add.post.view')}}">Thêm Bài Viết</a>
                </button>
                </br>
               Tìm kiếm
                <select name="" id="fillter-category" style="margin:10px 0;padding:5px">
                    <option value="">Danh Mục</option>
                    @foreach($categorys as $category)
                    <option value="{{$category->id}}">{{$category->CategoryName}}</option>
                    @endforeach
                </select>
                </br>

                    <table id="customers" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <input type="hidden" value="{{$i=0}}">
                                <th>STT</th>
                                <th>Danh Mục</th>
                                <th>Tiêu Đề</th>
                                <th>Ngày tạo</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                    </table>
                </div>

        </div>
    </div>
@push('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.4/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sl-1.4.0/datatables.min.css"/>
<script src="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.4/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sl-1.4.0/datatables.min.js"></script>

<script>
    $(document).ready(function() {
        let post_table = $('#customers').DataTable({
            dom: 'Bfrtip',
            processing: true,
            serverSide: true,
            select:true,
            ajax: '{!! route('admin.post.indexApi') !!}',
            columns: [
                { data:'id', name:'id'},
                { data: 'category_id', name: 'category_id' },
                { data: 'title', name: 'title' },
                { data: 'created_at', name: 'created_at' },
                
                {
                    data:'edit',
                    targets:4,
                    orderable:true,
                    searchable:true,
                    render:function(data,type,row,meta){
                        return `<a href="${data}" class="btn btn-success bg-success">Sửa</a>`;
                    }
                },
                {
                    data:'delete',
                    targets:5,
                    orderable:true,
                    searchable:true,
                    render:function(data,type,row,meta){
                        console.log(data);
                        return `<form action="${data}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="if (!confirm('Bạn có muốn xóa bài viết không?')) { return false }" id="delete-button">Xóa</button>
                        </form>`;
                    }
                }
                
            ],
        });
        $('#fillter-category').on('change',function(){
            let category_id = $(this).val();
            post_table.columns(1).search(category_id).draw();
        });
        post_table.on( 'draw.dt', function () {
            var PageInfo = $('#customers').DataTable().page.info();
            let i = 1;
            post_table.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                    cell.innerHTML = i + 1 + PageInfo.start;
                } );
    } );
    });

</script>

