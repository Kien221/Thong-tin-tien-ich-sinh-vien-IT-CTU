@section('title'){{'Thêm nhà trọ'}} @endsection
    @include('layout.header_admin')
    <div class="container-fluid">
       <div class="row contain">
        @include('layout.sidebar_admin')
        <div class="col-xs-9">
            <div class="table">
               <form action="{{route('admin.recuit.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form">
                            <p>Tên Công ty</p>
                            <input type="text"  name="Company_Name" style="margin-left:63px">
                            <input type="hidden" name="slug">
                        </div>
                        <div class="form">
                            <p>Tỉnh</p>
                            <select name="city_id" id="" style="margin-left:114px">
                                <option value="">Chọn Tỉnh</option>
                                @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form">
                            <p>Địa Chỉ</p>
                            <input type="text"  name="Address" style="margin-left:95px">
                        </div>
                        <div class="form" style="width:50%">
                            <p>email</p>
                            <input type="email"  name="company_email" style="margin-left:108px;">
                        </div>
                        <div class="form" style="width:50%">
                            <p>Tên bài đăng</p>
                            <input type="text"  name="job_title" style="margin-left:57px;">
                        </div>
                        <div class="form" style="width:50%">
                            <p style="margin-right:100px;">Ngôn ngữ</p>
                            @foreach ($languages as $language)
                            <input type="checkbox" name="language_id[]" value="{{$language->id}}" style="height:25px;">{{$language->Language_Name}}
                            @endforeach
                        </div>
                        <div class="form" style="width:50%">
                            <p>mức lương</p>
                            <input type="text"  name="salary" style="margin-left:68px;">
                        </div>
                        <div class="form">
                            <p>Chọn ảnh đại diện</p>
                            <input type="file" name="img">
                        </div>
                        <div class="form">
                            <p>Mô tả</p>
                        </div>
                        <textarea name="job_description" id="editor" cols="30" rows="10">
                        </textarea>
                    <button class="btn btn-success bg-success" id="create-post">Thêm bài tuyển dụng</button>
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
    $('#create-post').click(function(){
        alert("Tạo bài viết thành công");
    })
    </script>
