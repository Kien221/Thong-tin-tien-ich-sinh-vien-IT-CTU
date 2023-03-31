<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>Quản Lý Danh Mục</title>
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
            color:white;
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
               <form action="{{route('update.category',$category)}}" method="post">
                  @csrf
                  @method('PUT')
                  <label for="">Tên Danh Mục
                    <input type="text" value="{{$category->CategoryName}}" name="categoryName">
                  </label>
                  <button type="submit" id="add-category" style=" color:white;padding:10px">Lưu</button>
               </form>
            </div>
        </div>
       </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#save').click(function(){
            alert('Lưu thành công');
        });
    });
</script>
</body>

</html>