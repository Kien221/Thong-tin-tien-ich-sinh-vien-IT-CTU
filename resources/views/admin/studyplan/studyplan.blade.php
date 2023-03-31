@section('title'){{'- Chương Trình Đào Tạo'}} @endsection
<body>
    @include('layout.header_admin')
    <div class="container-fluid">
       <div class="row contain">
        @include('layout.sidebar_admin')
        <div class="col-xs-9">

            <table border="1" id ="customers" class="table" style="width:100%">
                        <thead>
                            <tr>
                                <input type="hidden" value="{{$i=0}}">
                                <th>STT</th>
                                <th>Khoa</th>
                                <th>Ngành</th>
                                <th>file KHHT</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        @foreach($majors as $major)
                        <tbody>
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$major->Khoas->Khoa_Name}}</td>
                                <td>{{$major->Major_Name}}</td>
                                <td><a href="{{asset('storage/file_doc_upload/'.$major->file)}}" target=”_blank”>{{$major->file}}</a></td>
                                <td><a href="{{route('admin.edit.study_plan',$major)}}" class="btn btn-success bg-success">Sửa</a></td>
                        @endforeach
                    </table>
          </div>
       </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
 
</script>
</body>
</html>