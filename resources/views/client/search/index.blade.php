<style>
    .item-search_post{
   margin: 10px 0;
}
.item-search_post a{
    text-decoration: none;
    color: #1269B5;
    font-size: 16px;
}
.item-search_post a i{
    margin-right: 5px;
}
</style>
@if(count($posts) > 0)
@foreach ($posts as $post)
    <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
            <img src="{{ asset('storage/images/posts/'.$post->image) }}" alt="" class="card-img-top">
            <div class="card-body">
            <li class="item-search_post" value="{{$post->id}}" style="margin-left: 20px;list-style:none;"><a href="#" value="$post->id">
                <i class="fa-solid fa-caret-right"></i>{{$post->title}}</a></li>
        </div>
    </div>
@endforeach
@else
    <div class="col-md-12">
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h3>Không tìm thấy bài viết nào</h3>
            </div>
        </div>
    </div>
@endif
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        const element = document.querySelectorAll('.item-search_post');
        console.log(element);
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
            }
          }
    })
</script>



