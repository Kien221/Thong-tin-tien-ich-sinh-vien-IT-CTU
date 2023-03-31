
    @include('layout.header')
    <div class="body">
        @include('layout.menu')
                <div style="display:flex">

                    <div class="sidebar">
                        <div class="sidebar-item">
                            <div class="title-sidebar">
                                <span>Xác nhận và nộp hồ sơ nhập học</span>
                            </div>
                            <div class="sidebar-content">
                                <ul class="list-sidebar">
                                    @foreach($posts_profile as $post_profile)
                                    <li class="item-sidebar" value="{{$post_profile->id}}"><a href="#" value="$post_study->id">
                                        <i class="fa-solid fa-caret-right"></i>{{$post_profile->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-item">
                            <div class="title-sidebar">
                                <span>Sinh Hoạt-Học Tập</span>
                            </div>
                            <div class="sidebar-content">
    
                                <ul class="list-sidebar">
                                <li class="item-sidebar"><a href="#">
                                        <i class="fa-solid fa-caret-right"></i>Nội quy - Quy Định</a></li>
                                    @foreach($posts_role as $post_role)
                                    <li class="item-sidebar" value="{{$post_role->id}}" style="margin-left: 20px;">
                                    
                                    <a href="#" value="$post_role->id">
                                        <i class="fa-solid fa-caret-right"></i>
                                        {{$post_role->title}}
                                    </a>
                                    </li>
                                    @endforeach
                                    <li class="item-sidebar"><a href="#">
                                        <i class="fa-solid fa-caret-right"></i>Sinh hoạt</a></li>
                                    @foreach($posts_activity as $post_activity)
                                    <li class="item-sidebar" value="{{$post_activity->id}}" style="margin-left: 20px;"><a href="#" value="$post_activity->id">
                                        <i class="fa-solid fa-caret-right"></i>{{$post_activity->title}}</a></li>
                                    @endforeach
                                    <li class="item-sidebar"><a href="#">
                                        <i class="fa-solid fa-caret-right"></i>Học tập</a></li>
                                    @foreach($posts_study as $post_study)
                                    <li class="item-sidebar" value="{{$post_study->id}}" style="margin-left: 20px;"><a href="#" value="$post_study->id">
                                        <i class="fa-solid fa-caret-right"></i>{{$post_study->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-item">
                            <div class="title-sidebar">
                                <span>Học phí - Học bổng - Chế độ chính sách</span>
                            </div>
                            <div class="sidebar-content">
                                <ul class="list-sidebar">
                                    @foreach($posts_policy as $post_policy)
                                    <li class="item-sidebar" value="{{$post_policy->id}}"><a href="#" value="$post_policy->id">
                                        <i class="fa-solid fa-caret-right"></i>{{$post_policy->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                    @include('layout.chatbox')  
                    <div class="content">
                       <div class="main-content" style="display:flex;">
          <div class="art-content-layout-row" style="display:flex;"><div class="art-layout-cell" style="width: 50%;"><article class="art-post"><div class="art-postcontent clearfix"><div class="custom">
        <div style="border: 1px solid #ccc; padding: 7px;">
    <p style="margin-top: 3pt; margin-bottom: 3pt;"><a href="#" style="text-decoration:none;"><span style="color: #ff0000;"><strong><img style="margin: -20px 0px 0px 3px;" src="{{asset('img/yelp-star-animation.gif')}}" width="22" height="17"><span style="color: #ff0000;">Thông báo mới nhất</span></strong></span></a></p>
    
    <div class="sidebar-new-post">
        <ul class="list-new-post">
            @foreach($posts_newer as $post_new)
            <li class="item-new-post" value="{{$post_new->id}}" style="margin-left: 20px;"><a href="#" value="$post_new->id">
            <i class="fa-solid fa-caret-right"></i>{{$post_new->title}}</a></li>
            @endforeach
        </ul>
    </div>
    
    </div></div></div></article></div><div class="art-layout-cell" style="width: 50%;"><article class="art-post"><div class="art-postcontent clearfix"><div class="custom">
        <div style="border: 1px solid #ccc; padding: 7px;"><span style="color: #003366;"><strong>Liên hệ hỗ trợ:&nbsp;</strong></span>
    <p style="line-height: 200%; margin-top: 0; margin-bottom: 0;">+ Phòng Đào tạo: 0292.3872&nbsp;728</p>
    <p style="line-height: 200%; margin-top: 0; margin-bottom: 0;"><span style="font-family: Arial; font-size: small;">+ Phòng Công tác Sinh viên: 0292.3872 177</span></p>
    <p style="line-height: 200%; margin-top: 0; margin-bottom: 0;"><span style="font-family: Arial; font-size: small;">+ Đoàn Thanh niên trường: 0292. 3830 309</span>&nbsp;</p>
    <p style="line-height: 200%; margin-top: 0; margin-bottom: 0;">+ Trung tâm Tư vấn, Hỗ trợ &amp; KNSV:&nbsp;0292.3872284 / 02923.943727</p>
    </div></div></div></article></div></div></div>
                       </div>
                </div>
                </div>
        </div>
                </div>

    <script>
        $(document).ready(function(){
          $('.item-sidebar').click(function(){
            $post_id = $(this).val();
            console.log($post_id);
            let route = '{{route('post.details')}}';
            $.ajax({
                url:route,
                type:'GET',
                data:{
                    post_id:$post_id,
                },
                dataType:'json',
                success:function(data){
                    console.log(data);
                    $('.content').html($('.main-content'));
                    $time_post = data.created_at; 
                    console.log($time_post);
                    $('.content').append(
                        `<div class="post">
                            <div class="title-post">
                                <a href="" class="post-link">${data.title}</a>
                                
                            </div>
                            <div class="">
                                <div class="content-post">
                                    ${data.description}
                                </div>
                            </div>
                        </div>`
                    );
                    if(data.file != null){
                        $('.content-post').append(
                            `<div class="download">
                                <a href="{{asset('storage/file_doc_upload/${data.file}')}}" target=”_blank”>Xem chi tiết</a>
                            </div>`
                        );
                    }
                },
                error:function(error){
                    console.log(error);
                }
            })
          })
          $('.post-link').click(function(){
            window.location.reload();
          })
          const element = document.querySelectorAll('.item-new-post');
          if(element.length !== 0){
            for(let i = 0 ; i < element.length ; i++){
                element[i].addEventListener('click',function(){
                    $post_id = $(this).val();
                    console.log($post_id);
                    let route = '{{route('post.details')}}';
                    $.ajax({
                        url:route,
                        type:'GET',
                        data:{
                            post_id:$post_id,
                        },
                        dataType:'json',
                        success:function(data){
                            console.log(data);
                            $('.content').html($('.main-content'));
                            $time_post = data.created_at; 
                            $('.content').append(
                                `<div class="post">
                                    <div class="title-post">
                                        <a href="" class="post-link">${data.title}</a>
                                        
                                    </div>
                                    <div class="">
                                        <div class="content-post" style="padding:15px">
                                            ${data.description}
                                        </div>
                                    </div>
                                </div>`
                            );
                            if(data.file != null){
                                $('.content-post').append(
                                    `<div class="download">
                                        <embed src="{{asset('storage/file_doc_upload/${data.file}')}}" width="800" height="675">
                                    </div>`
                                );
                            }
                        },
                        error:function(error){
                            console.log(error);
                        }
                    })
                })
            }
          }
        
        });
    </script>
    

