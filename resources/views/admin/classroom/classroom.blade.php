@section('title'){{'Quản lí phong hoc'}} @endsection
    @include('layout.header_admin')
    <div class="container-fluid">
       <div class="row contain">
        @include('layout.sidebar_admin')
        <div class="col-xs-9">
            <div style="display:flex;justify-content: space-between">
                    <form action="{{route('admin.import.classroom')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file" id="file" class="form-control" accept=".xlsx">
                                    <br>
                                    <input type="submit" name = "import_classrooms" value="Thêm Phòng Học" class="btn btn-success" id="excel" style="margin-bottom:10px">
                    </form>
                <div class="row">
                      
                </div>

            </div>
      

                <table class="table" border="1" id = "motels_table">
                    <tr>
                            <th>STT</th>
                            <th>Mã Phòng Học</th>
                            <th>Tên Phòng Học</th>
                            <th>Đường Đi</th>
                    </tr>
                    @foreach($classrooms as $classroom)
                    <tr>
                        <td>{{$classroom->id}}</td>
                        <td>{{$classroom->room_PW}}</td>
                        <td>{{$classroom->room_name}}</td>
                        <td>{{$classroom->detail_way}}</td>
                    @endforeach

                </table>
                @if(session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
                @endif
          </div>
       </div>
    </div>
