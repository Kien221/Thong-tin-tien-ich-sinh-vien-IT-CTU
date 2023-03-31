@section('title'){{$motel->MotelName}} @endsection
@include('layout.header')
<div class="body">
    @include('layout.menu')
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
            <h1 class="page-h1"><span class="star star-5" style="float: left;"></span><a style="color: #E13427;" href="#" title="Cho thuê phòng cao cấp, đầy đủ tiện nghi, như căn hộ, ngay trung tâm Quận 10" class="title_detail_motel">{{$motel->MotelName}}</a></h1>
            <address class="post-address"><i class="fa-solid fa-location-dot"></i>{{$motel->Address}}</address>
            <div class="price-clock">
                <div class="item-price"><i class="fa-solid fa-money-bill-1-wave"></i><span style="color: #16c784; font-weight: bold; font-size: 1.5rem">{{$motel->prices}}</span></div>
                <div class="item-published"><i class="fa-regular fa-clock"></i><span title="Thứ 4, 11:34 05/10/2022">{{$motel->created_at->diffForHumans()}}</span></div>
            </div>
            <section class="section post-main-content"><div class="section-header"><h2 class="section-title" style="font-size:20px;margin-bottom:20px">Thông tin mô tả</h2></div><div class="section-content">{!! $motel->Description !!}</div></section>
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

