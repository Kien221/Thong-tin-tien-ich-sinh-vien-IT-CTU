@section('title'){{'Thêm nhà trọ'}} @endsection
    @include('layout.header_admin')
    <div class="container-fluid">
       <div class="row contain">
        @include('layout.sidebar_admin')
        <div class="col-xs-9">
            <div class="table">
               <form action="{{route('admin.major_study_plan.update',$major)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form">
                            <p>Ngành</p>
                            <select name="major_id" style="margin-left:87px">
                                <option value="{{$major->id}}">{{$major->Major_Name}}</option>
                                @foreach($majors as $major)
                                <option value="{{$major->id}}">{{$major->Major_Name}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form">
                                    <p>Chọn file (Excel)</p>
                                    <input type="file" name="file_excel" id="file" class="form-control" accept=".xlsx" style="width: 24%;margin-right:5px">
                                    
                                </div>
                                <div class="form">
                                    <button class="btn btn-success bg-success" type="submit">Lưu KHHT</button>
                                </div>
                </form>
            </div>
        </div>
       </div>
    </div>
</body>


