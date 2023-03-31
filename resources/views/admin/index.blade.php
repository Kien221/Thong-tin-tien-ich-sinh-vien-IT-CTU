<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>AdMin</title>
    <style>
        .main{
            text-align:center;margin-top: 50px;border:1px solid white;
            padding: 50px;
        }
        ul{
           width: 100%;
           list-style: none;
           font-size: 20px;
           text-align:center
        }
        ul li{
            width: 50%;
            padding: 15px;
            background-color: #fff;
            margin-top:10px;
            margin-left:400px;
        }
        ul li a{
            color:black;
            text-decoration: none;
        }
    </style>
</head>
<body>
    @include('layout.header')
    <div class="main">
        <ul style="color:white">
            <li><a href="{{route('admin.category')}}">Quản Lý Danh Mục</a></li>
            <li><a href="{{route('admin.post')}}">Quản Lý Bài Viết</a></li>
        </ul>
    </div>
</body>
</html>