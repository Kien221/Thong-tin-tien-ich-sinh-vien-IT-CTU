@if(session('success'))
@foreach($postrecruit_fillter as $postRecruit)
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
                                        <span style="padding:5px;border:1px solid black;border-radius:5px;background:linear-gradient(to bottom, #58FA58, #088A08) no-repeat;margin-right:10px;color:white">
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

@else
<h3>Không có tin tuyển dụng nào</h3>
@endif
