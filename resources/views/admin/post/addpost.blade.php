@section('title'){{'Thêm bài đăng'}} @endsection
    @include('layout.header_admin')
    <div class="container-fluid">
       <div class="row contain">
        @include('layout.sidebar_admin')
        <div class="col-xs-9">
            <div class="table">
               <form action="{{route('admin.addpost.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form">
                            <p>Danh Mục</p>
                            <select name="category_id">
                                <option value="">Chọn Danh mục</option>
                                @foreach($categorys as $category)
                                    <option value="{{$category->id}}">{{$category->CategoryName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form">
                            <p>Tiêu Đề</p>
                            <input type="text"  name="title" style="margin-left:90px" required>
                        </div>
                        <div class="form">
                            <p>Chọn ảnh đại diện</p>
                            <input type="file" name="img" >
                        </div>
                        <div class="form">
                            <p>Nội Dung</p>
                        </div>
                        <textarea name="description" id="editor" cols="30" rows="10">
                        </textarea>
                        <div class="form">
                            <p>file đính kèm (Nếu có)</p>
                            <input type="file" name="file-pdf">
                        </div>
                    <button class="btn btn-success bg-success" id="create-post">Tạo bài viết</button>
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
