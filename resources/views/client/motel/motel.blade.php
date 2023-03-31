@section('title'){{'- Tìm Kiếm Nhà Trọ'}} @endsection
@include('layout.header')
<div class="body">

    @include('layout.menu')
    @include('layout.chatbox')
    <div class="motel-content">
        <div class="motel-fillter">
            <div class="district-fillter">
                <select name="" id="district-fillter">
                    <option value="-1">Chọn quận</option>
                    @foreach ($districts as $district)
                    <option value="{{$district->id}}">{{$district->DistrictName}}</option>
                    @endforeach
                </select>
            </div>
            <div class="wards-fillter">
                <select name="" id="wards-fillter">
                    <option value="">Chọn phường/xã</option>
                    @foreach ($wards as $ward)
                    <option value="{{$ward->id}}">{{$ward->WardName}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="motel-content-post">
            <div class="motel-content-left">
                @foreach($motel_ramdoms as $motel_ramdom)
                <div class="motel-post">
                    <a href="{{route('client.motel.detail',$motel_ramdom->slug)}}">
                        <img src="{{asset('storage/images/motel/'.$motel_ramdom->img)}}" alt="" class="motel-img">
                    </a>
                    <div class="motel-info">
                        <a href="{{route('client.motel.detail',$motel_ramdom->slug)}}" class="title-link">
                            <h3 class="motel-name">{{$motel_ramdom->MotelName}}</h3>
                        </a>
                        <div class="motel-info_cost-address">
                            <p class="motel-cost">{{$motel_ramdom->prices}}</p>
                            <span class="motel-address">{{$motel_ramdom->Address}}</span>
                        </div>
                        <div class="motel-description">{!!$motel_ramdom->Description!!}</div>
                        <div class="user-post">
                            <div class="user-post-info">
                                <img src="https://phongtro123.com/images/default-user.png" alt="" class="user-post-img">
                                <div class="user-post-info_name">
                                    <p class="user-post-name">Nguyễn Văn A</p>
                                    <p class="user-post-time">{{$motel_ramdom->created_at->format('d/m/Y')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="motel-content-right">
                <h2 class="header-new-post">Tin mới đăng</h2>
                @foreach($motel_news as $motel_new)
                <div class="motel-post-new">
                    <a href="{{route('client.motel.detail',$motel_new->slug)}}">
                        <img src="{{asset('storage/images/motel/'.$motel_new->img)}}" alt="" class="motel-img-new-post">
                    </a>
                    <div class="motel-post-info-new">
                        <a href="{{route('client.motel.detail',$motel_new->slug)}}" class="motel-title-new-post">
                            <h4>{{$motel_new->MotelName}}</h4>
                        </a>
                        <div class="cost-time-post">
                            <p class="motel-cost-new">{{$motel_new->prices}}</p>
                            <p class="motel-time-new">{{ $motel_new->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
       

    </div>
</div>

<script>
    $(document).ready(function(){
        $('#district-fillter').change(function(){
            let district_id = $(this).val();
            let route ='{{route('district.fillter.motel')}}';
            $.ajax({
                url : route,
                type: 'GET',
                data: {
                    district_id: district_id
                },
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    $('#wards-fillter').html("");
                    $('#wards-fillter').append('<option value="">Chọn Phường/Xã</option>');
                    $.each(data.wards,function(key,value){
                        let selection = '';
                        selection += "<option value='"+value.id+"'>"+value.WardName+"</option>";
                        $('#wards-fillter').append(selection);
                    });

                    if(data.motels_on_district.length > 0){
                           $('.motel-content-left').html("");
                           for(var motels_on_district of data.motels_on_district){
                            $motel_slug = motels_on_district.slug;
                            var link = "{{route('client.motel.detail',['slug'=>'motels_on_district.slug'])}}";
                            $url = link.replace('motels_on_district.slug',$motel_slug);
                            $img = "{{asset('storage/images/motel')}}"+'/'+motels_on_district.img;
                            $post_time = motels_on_district.formatted_created_at;
                            console.log($post_time);
                            $('.motel-content-left').append(
                                '<div class="motel-post">\
                                    <a href="'+$url+'">\
                                        <img src="'+$img+'" alt="" class="motel-img">\
                                    </a>\
                                    <div class="motel-info">\
                                        <a href="'+$url+'" class="title-link">\
                                            <h3 class="motel-name">'+motels_on_district.MotelName+'</h3>\
                                        </a>\
                                        <div class="motel-info_cost-address">\
                                            <p class="motel-cost">'+motels_on_district.prices+'</p>\
                                            <span class="motel-address">'+motels_on_district.Address+'</span>\
                                        </div>\
                                        <div class="motel-description">'+motels_on_district.Description+'</div>\
                                        <div class="user-post">\
                                            <div class="user-post-info">\
                                                <img src="https://phongtro123.com/images/default-user.png" alt="" class="user-post-img">\
                                                <div class="user-post-info_name">\
                                                    <p class="user-post-name">Nguyễn Văn A</p>\
                                                    <p class="user-post-time">'+motels_on_district.formatted_created_at+'</p>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                </div>\
                                '
                            );
                           }
                    }
                    else {
                        $('.motel-content-left').html("");
                        $('.motel-content-left').append(
                            '<div class="motel-post">\
                                <h3 class="not-motel">Không có phòng trọ nào</h3>\
                            </div>\
                            '
                        );
                    }
                },
                error: function(error){
                    console.log(error);
                }

            })
        })
        if($('#district-fillter').val() !== -1){
            $('#wards-fillter').change(function(){
                $ward_id = $(this).val();
                $district_id = $('#district-fillter').val();
                console.log($ward_id);
                let route ='{{route('ward.fillter.motel')}}';
                $.ajax({
                    url: route,
                    type: 'GET',
                    data: {
                        district_id : $district_id,
                        ward_id: $ward_id
                    },
                    dataType: 'json',
                    success:function(data){
                        console.log(data);
                        if(data.motels_on_ward.length > 0){
                            $('.motel-content-left').html("");
                            for(var motels_on_ward of data.motels_on_ward){
                                $motel_slug = motels_on_ward.slug;
                                var link = "{{route('client.motel.detail',['slug'=>'motels_on_ward.slug'])}}";
                                $url = link.replace('motels_on_ward.slug',$motel_slug);
                                $img = "{{asset('storage/images/motel')}}"+'/'+motels_on_ward.img;
                                $post_time = motels_on_ward.formatted_created_at;
                                
                                console.log($post_time);
                                $('.motel-content-left').append(
                                    '<div class="motel-post">\
                                        <a href="'+$url+'">\
                                            <img src="'+$img+'" alt="" class="motel-img">\
                                        </a>\
                                        <div class="motel-info">\
                                            <a href="'+$url+'" class="title-link">\
                                                <h3 class="motel-name">'+motels_on_ward.MotelName+'</h3>\
                                            </a>\
                                            <div class="motel-info_cost-address">\
                                                <p class="motel-cost">'+motels_on_ward.prices+'</p>\
                                                <span class="motel-address">'+motels_on_ward.Address+'</span>\
                                            </div>\
                                            <div class="motel-description">'+motels_on_ward.Description+'</div>\
                                            <div class="user-post">\
                                                <div class="user-post-info">\
                                                    <img src="https://phongtro123.com/images/default-user.png" alt="" class="user-post-img">\
                                                    <div class="user-post-info_name">\
                                                        <p class="user-post-name">Nguyễn Văn A</p>\
                                                        <p class="user-post-time">'+motels_on_ward.formatted_created_at+'</p>\
                                                    </div>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                    '
                                );
                            }
                        }
                        else {
                            $('.motel-content-left').html("");
                            $('.motel-content-left').append(
                                '<div class="motel-post">\
                                    <h3 class="not-motel">Không có phòng trọ nào</h3>\
                                </div>\
                                '
                            );
                        }
                    },
                    error:function(error){
                        console.log(error);
                    }

                })
            })
        }
    })
</script>