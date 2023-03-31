@section('title'){{'Quản lí danh mục'}} @endsection
    @include('layout.header_admin')
    <div class="container-fluid">
       <div class="row contain">
        @include('layout.sidebar_admin')
        <div class="col-xs-9">
            <button>
                <a href="{{route('admin.add.category.view')}}">Thêm Danh Mục</a>
            </button>
            <div class="table">
                <table id="customers">
                    <tr>
                        <th>STT</th>
                        <th>Tên Danh Mục</th>
                        <th>Thao Tác</th>
                    </tr>
                    <input type="hidden" value="{{$i=0}}">
                    @foreach($categorys as $category)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$category->CategoryName}}</td>
                        <td style="display:flex;justify-content: center;" >
                          
                                <a href="{{route('category.update.view',$category)}}" class="btn btn-success bg-success" style="margin:5px">Sửa</a>

                            <form action="{{route('delete.category',$category)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" style="margin: 5px;" onclick="if (!confirm('Bạn có muốn xóa danh mục?')) { return false }" id="delete">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
                
            </div>
          </div>
       </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
 
</script>

