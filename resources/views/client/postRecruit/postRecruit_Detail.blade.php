@section('title'){{$post_recruit->company_name}} @endsection
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
            <div class="ward-fillter">
                <select name="" id="district-fillter">
                    <option value="-1">Ngôn Ngữ</option>
                    @foreach($language_all as $language)
                        <option value="{{$language->id}}">{{$language->Language_Name}}</option>
                    @endforeach
                 
                    <option value=""></option>
               
                </select>
            </div>
        </div>
        <div class="motel-content-post">
            <div class="motel-content-left">
            <div class="motel-post" style="border:1px solid #2E9AFE;background-color:#CEECF5;padding:10px">
                    <a href="{{route('client.detail.postrecruit',$post_recruit->slug)}}">
                        <img src="{{asset('storage/images/postRecruit/'.$post_recruit->logo)}}" alt="" class="motel-img">
                    </a>
                    <div class="motel-info">
                        <a href="{{route('client.detail.postrecruit',$post_recruit->slug)}}" class="title-link">
                            <h3 class="motel-name" style="color:red">{{$post_recruit->job_title}}</h3>
                        </a>
                        <address class="post-address"><i class="fa-solid fa-location-dot"></i>{{$post_recruit->company_address}}</address>
                        <div class="price-clock" style="margin-bottom:15px">
                            <div class="item-price"><i class="fa-solid fa-money-bill-1-wave"></i><span style="color: #16c784; font-weight: bold; font-size: 1.5rem">{{$post_recruit->salary}}</span></div>
                            <div class="item-published"><i class="fa-regular fa-clock"></i><span title="Thứ 4, 11:34 05/10/2022">{{$post_recruit->created_at->diffForHumans()}}</span></div>
                        </div>
                        @foreach($languages as $language)
                            <span style="padding:5px;border:1px solid black;border-radius:5px;background:linear-gradient(to bottom, #58FA58, #088A08) no-repeat;margin-right:10px;color:white">
                                    {{$language->Language_Name}}
                            </span>
                        @endforeach
                    </div>
            </div>   
            
            <section class="section post-main-content"><div class="section-header"><h2 class="section-title" style="font-size:20px;margin-bottom:20px">Thông tin mô tả</h2>
            </div>
                <div class="section-content" style="padding:20px">{!! $post_recruit->job_description !!}</div>
            </div>
        </section>
            <div class="motel-content-right">
                <h2 class="header-new-post">Tin mới đăng</h2>
             @foreach($postRecruits_new as $postRecruit)
                <div class="motel-post-new" style="background-color:#CEECF5;padding:10px">
                    <a href="{{route('client.detail.postrecruit',$postRecruit->slug)}}">
                        <img src="{{asset('storage/images/postRecruit/'.$postRecruit->logo)}}" alt="" class="motel-img-new-post">
                    </a>
                    <div class="motel-post-info-new">
                        <a href="{{route('client.detail.postrecruit',$postRecruit->slug)}}" class="motel-title-new-post">
                            <h4>{{$postRecruit->company_name}}</h4>
                        </a>
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

