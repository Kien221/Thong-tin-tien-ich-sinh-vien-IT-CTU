@section('title'){{'Thêm nhà trọ'}} @endsection
    @include('layout.header_admin')
    <div class="container-fluid">
       <div class="row contain">
        @include('layout.sidebar_admin')
        <div class="col-xs-9">
            <div class="table">
               <form action="{{route('admin.motel.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form">
                            <p>Quận/Huyện</p>
                            <select id="district_id" style="margin-left:61px">
                                <option value="">Chọn Quận/Huyện</option>
                                @foreach($districts as $district)
                                <option value="{{$district->id}}">{{$district->DistrictName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form">
                            <p>Phường/Xã</p>
                            <select id="ward_id" style="margin-left:66px" name="ward_id">
                                <option value="">Chọn Phường/Xã</option>
                                @foreach($wards as $ward)
                                <option value="{{$ward->id}}">{{$ward->WardName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form">
                            <p>Tên nhà trọ</p>
                            <input type="text"  name="MotelName" style="margin-left:63px" required>
                            <input type="hidden" name="slug">
                        </div>
                        <div class="form">
                            <p>Địa Chỉ</p>
                            <input type="text"  name="Address" style="margin-left:90px" required>
                        </div>
                        <div class="form" style="width:50%">
                            <p>Số điện thoại</p>
                            <input type="text"  name="Phone" style="margin-left:52px;" required> 
                        </div>
                        <div class="form" style="width:50%">
                            <p>Giá</p>
                            <input type="text"  name="prices" style="margin-left:114px;" required>
                        </div>

                        <div class="form">
                            <p>Chọn ảnh đại diện</p>
                            <input type="file" name="img" require>
                        </div>
                        <div class="form">
                            <p>Mô tả</p>
                        </div>
                        <textarea name="Description" id="editor" cols="30" rows="10">
                        </textarea>
                    <button class="btn btn-success bg-success" id="create-post">Thêm nhà trọ</button>
               </form>
            </div>
        </div>
       </div>
    </div>
</body>
<script>
       CKEDITOR.replace( 'editor', {
        filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
        filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserWindowWidth: '1000',
        filebrowserWindowHeight: '700'
    } );

    $(document).ready(function(){
        $('#district_id').change(function(){
            var district_id = $(this).val();
            console.log(district_id);
            $.ajax({
                url:'{{route('admin.motel.getWard')}}',
                type: 'GET',
                data: {
                    district_id: district_id
                },
                dataType: 'json',
                success:function(data){
                    console.log(data);
                    $('#ward_id').empty();
                    $('#ward_id').append('<option value="">Chọn Phường/Xã</option>');
                    $.each(data.getward,function(key,value){
                        let selection = '';
                        selection += "<option value='"+value.id+"'>"+value.WardName+"</option>";
                        $('#ward_id').append(selection);
                    });
                }
            })
        })
    })
    $('#create-post').click(function(){
        alert("Tạo bài viết thành công");
    })


    </script>
