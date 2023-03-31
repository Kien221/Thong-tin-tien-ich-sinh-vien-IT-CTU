<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @section('title'){{'Thêm danh mục'}} @endsection
    <style>
        .main{
            margin-top: 50px;border:1px solid white;
            padding: 50px;
            
        }
        .contain{
            background-color:white;
        }
        button{
            padding: 10px;
            font-size: 16px;
            border-radius:5px;
        }
        input{
            padding: 10px;
            margin-right:10px;
        }
       
    </style>
</head>
<body>
    @include('layout.header_admin')
    <div class="container-fluid">
       <div class="row contain">
        @include('layout.sidebar_admin')
        <div class="col-xs-9">

            <div class="table">
               <form action="{{route('admin.add.category')}}" method="post">
                  @csrf
                  <label for="">Tên Danh Mục
                    <input type="text" placeholder="Nhập tên danh mục" name="categoryName">
                  </label>
                  <button type="submit" id="add-category" style="color:white">Thêm</button>
               </form>
            </div>
        </div>
       </div>
    </div>
    <script>
        $('#add-category').click(function(){
            alert('Thêm thành công');
        });
    </script>
</body>
</html>