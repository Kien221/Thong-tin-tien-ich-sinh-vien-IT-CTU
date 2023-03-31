@section('title'){{'- Tìm Kiếm Nhà Trọ'}} @endsection
@include('layout.header')
<div class="body">

    @include('layout.menu')
    <div class="motel-content">
        <div class="motel-fillter" style="background-color:green;">
            <div class="district-fillter">
                <select name="" id="district-fillter">
                    <option value="-1">Chọn Tỉnh</option>
                    @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
               
                </select>
            </div>
            <div class="language-fillter" style="margin-left:50px">
                <select name="" id="language-fillter">
                    <option value="-1">Ngôn Ngữ</option>
                    @foreach($language_all as $language)
                        <option value="{{$language->id}}">{{$language->Language_Name}}</option>
                    @endforeach     
                </select>
            </div>
        </div>
        <div class="motel-content-post">
            <div class="motel-content-left">
                @foreach($postRecruit_random as $postRecruit)
                <div class="motel-post" style="border:1px solid #2E9AFE;background-color:#CEECF5;padding:10px">
                    <a href="{{route('client.detail.postrecruit',$postRecruit->slug)}}">
                        <img src="{{asset('storage/images/postRecruit/'.$postRecruit->logo)}}" alt="" class="motel-img">
                    </a>
                    <div class="motel-info">
                        <a href="{{route('client.detail.postrecruit',$postRecruit->slug)}}" class="title-link">
                            <h3 class="motel-name" style="color:red">{{$postRecruit->job_title}}</h3>
                        </a>
                        <div class="motel-info_cost-address">
                            <p class="motel-cost" >{{$postRecruit->salary}}</p>
                            <span class="motel-address" style="padding:5px;border:1px solid black;border-radius:10px;background-color:rgb(251, 251, 251)">{{$postRecruit->city->name}}</span>
                        </div>
                        
                        <span style="margin-bottom:15px"><i class="fa-solid fa-location-dot" style="color:#2ECCFA"></i> {{$postRecruit->company_address}}</span>
                        <div class="motel-description" style="margin:7px 0px;">{!!$postRecruit->job_description!!}
                        </div>
                        <div class="user-post">
                            <div class="user-post-info">
                                
                                <div class="user-post-info_name">
                                    
                                    @foreach($languages as $language)
                                        <span class="btn-language" style="padding:5px;border:1px solid white;border-radius:5px;background:linear-gradient(to bottom, #58FA58, #088A08) no-repeat;margin-right:10px;color:white">
                                            {{$language->Language_Name}}
                                        </span>
                                    @endforeach
                                    <p class="user-post-time">{{$postRecruit->created_at->format('d/m/Y')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
            <div class="motel-content-right">
                <h2 class="header-new-post">Tin mới đăng</h2>
             @foreach($postRecruit_new as $postRecruit)
                <div class="motel-post-new" style="background-color:#CEECF5;padding:10px">
                    <a href="{{route('client.detail.postrecruit',$postRecruit->slug)}}">
                        <img src="{{asset('storage/images/postRecruit/'.$postRecruit->logo)}}" alt="" class="motel-img-new-post">
                    </a>
                    <div class="motel-post-info-new">
                        <a href="{{route('client.detail.postrecruit',$postRecruit->slug)}}" class="motel-title-new-post">
                            <h4>{{$postRecruit->company_name}}</h4>
                        </a>
                        <div class="user-post-info_name" style="margin-top:10px">
                            @foreach($languages_new_post as $language)
                                <span class="btn-language" style="padding:5px;border:1px solid white;border-radius:5px;background:linear-gradient(to bottom, #58FA58, #088A08) no-repeat;margin-right:10px;color:white">
                                    {{$language->Language_Name}}
                                </span>
                            @endforeach
                        </div>
                        <div class="cost-time-post">
                               
                                    <p class="motel-cost-new">{{$postRecruit->salary}}</p>
                                    <p class="motel-time-new">{{$postRecruit->created_at->diffForHumans() }}</p>
                              
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
        if($('#district-fillter').val() !== -1){
            $('#district-fillter').change(function(){
                $district_id = $('#district-fillter').val();
                console.log($district_id);
                let route ='{{route('district.fillter.postrecruit')}}';
                $.ajax({
                    url: route,
                    type: 'GET',
                    data: {
                        district_id : $district_id,
                    },
                    dataType: 'json',
                    success:function(data){
                        $('.motel-content-left').html("");
                        $('.motel-content-left').html(data.data_html);   
    
                    },
                    error:function(error){
                        console.log(error);
                    }

                })
            })
        }
        $('#language-fillter').change(function(){
                $language_id = $(this).val();
                console.log($language_id);
                let route ='{{route('language.fillter.postrecruit')}}';
                $.ajax({
                    url: route,
                    type: 'GET',
                    data: {
                        language_id : $language_id,
                    },
                    dataType: 'json',
                    success:function(data){
                        console.log(data);
                        $('.motel-content-left').html("");
                        $('.motel-content-left').html(data.data_html);   
    
                    },
                    error:function(error){
                        console.log(error);
                    }

                })
            })

    })
</script>

