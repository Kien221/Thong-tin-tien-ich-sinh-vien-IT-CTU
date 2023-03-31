
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name','Thông tin tiện ích sinh viên')}} @yield('title')</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/vi/thumb/6/6c/Logo_Dai_hoc_Can_Tho.svg/640px-Logo_Dai_hoc_Can_Tho.svg.png" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css "/>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('ckeditor/ckfinder.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/toasty.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/toasty.js"></script>
</head>
<body>
    <div class="header-admin">
            <div class="header-left-admin">
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
                <div class="admin-login" style="margin-right:100px;display:flex;">
                <img src="https://phongtro123.com/images/default-user.png" alt="" class="user-post-img">
                @if(session('admin_id'))
                <p class="admin-name" style="margin-top: 7px;margin-left: 10px;font-size:17px">{{session('admin_pw')}}</p>
                @endif
                </div>
                <a href="{{route('admin.logout')}}" class="btn btn-danger" style="margin-left: 62px;margin-top: -30px;">Thoát</a>
            </div>
    </div>
    
</body>
</html>