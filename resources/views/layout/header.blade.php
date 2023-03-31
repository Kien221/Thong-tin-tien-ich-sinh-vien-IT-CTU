<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name')}} @yield('title')</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/vi/thumb/6/6c/Logo_Dai_hoc_Can_Tho.svg/640px-Logo_Dai_hoc_Can_Tho.svg.png" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css "/>
    
    
    
</head>
<body>
    <div class="header">
            <div class="header-left">
                <div class="logo-header">
                    <img src="{{asset('img/1200px-Logo_Dai_hoc_Can_Tho.svg.png')}}" alt="">
                </div>
                <div class="title-header">
                    <span>Thông Tin</span>
                    <br>
                    <p>Tiện Ích Cho <i>SINH VIÊN</i></p>
                </div>
            </div>
            <div class="header-right">
                <div class="search">
                    <input type="text" placeholder="Nhập tìm kiếm" class="search-input">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </div>
    </div>
    
</body>
</html>