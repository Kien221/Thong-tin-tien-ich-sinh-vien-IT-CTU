<link rel="stylesheet" href="{{asset('css/boxchat.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css "/>
<body>
    <div class="control" id="show">
        <span class="call-now" rel="nofollow" data-original-title="" title="" >
                <img src="https://d1nhio0ox7pgb.cloudfront.net/_img/v_collection_png/512x512/shadow/help.png" style="width:80px" >
                <div class="animated infinite zoomIn alo-circle"></div>
                <div class="animated infinite pulse alo-circle-fill"></div>
        </span>
    </div>
    <div class="boxchat">
            <section class="chatbox">
              <section class="chat-window">
                <article class="msg-container msg-remote" id="msg-0">
                  <div class="msg-box">
                    <div class="flr">
                      <div class="messages">
                        <p style="text-align:center;font-weight:bold;padding: 5px;background-color: white;">Hỗ trợ sinh viên</p>
                        <ul>
                            <li><button onclick="FindClassRoom()" style="width:200px"><span style="cursor: pointer;color:white">Tìm kiếm phòng học</span> </button></li>
                            <li><button onclick="FindDocument()" style="width:200px"><a href="#">Tài liệu học tập</a> </button></li>   
                        </ul>

                      </div>
                  </div>
                </article>

                <!-- <article class="msg-container msg-self" id="msg-0">
                  <div class="msg-box">
                    <div class="flr">
                      <div class="messages">
                      </div>
                    </div>
                  </div>
                </article> -->
              </section>
              <div class="chat-input">
                <input type="text"  placeholder="Nhập tại đây" class="search-input" required/>
                <button>
                              <svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="rgba(255,255,255, 1)" d="M17,12L12,17V14H8V10H12V7L17,12M21,16.5C21,16.88 20.79,17.21 20.47,17.38L12.57,21.82C12.41,21.94 12.21,22 12,22C11.79,22 11.59,21.94 11.43,21.82L3.53,17.38C3.21,17.21 3,16.88 3,16.5V7.5C3,7.12 3.21,6.79 3.53,6.62L11.43,2.18C11.59,2.06 11.79,2 12,2C12.21,2 12.41,2.06 12.57,2.18L20.47,6.62C20.79,6.79 21,7.12 21,7.5V16.5M12,4.15L5,8.09V15.91L12,19.85L19,15.91V8.09L12,4.15Z" /></svg>
                          </button>
              </div>
            </section>
    </div>
</body>
<script>
    var click = false;
  document.getElementById('show').onclick = function() {
    if(!click){
        document.querySelector('.boxchat').style.display = 'block';
        click = true;
    }
    else{
        document.querySelector('.boxchat').style.display = 'none';
        click = false;
    }
  } 
function FindClassRoom(){
        $('.msg-remote').append('<div class="messages" style="text-align:center"><input type="text" placeholder="Nhập tên phòng học" class="input-classroom" style="padding:10px;margin-top:15px"></div>');
        $('.input-classroom').on('keyup',function(event){
            if(event.keyCode == 13){
            $(this).click();
            $value = $(this).val();
            console.log($value);
            $route = '{{route('findclassroom')}}';
            $.ajax({
                type : 'get',
                url : $route,
                data:{'search':$value},
                success:function(data){
                  console.log(data);
                  if(data.length == 0){
                    $('.msg-remote').append('<div class="messages" style="text-align:center"><p class="not-found">Không tìm thấy phòng học</p></div>');
                  }
                  else{
                    $.each(data,function(key,value){
                        $('.msg-remote').append(`<div class="add-mess msg-box"
                        <div class="msg-box" style="margin-top:10px">
                                  <div class="flr">
                                    <div class="messages" style="text-align:left">
                                        <p style="margin-left:15px">Mã Phòng: ${value.room_PW}</p>
                                        <p style="margin:5px 0px 5px 15px;">Loại Phòng: ${value.room_name}</p>
                                        <p style="margin-bottom:5px;"><i class="fa-sharp fa-solid fa-diamond-turn-right" style="color:green"></i>Đường đi: ${value.detail_way}</p>
                                    </div>
                                </div>
                                </div>`);
                    });
                  }
                }
            });
            if($('.input-classroom').keydown()){
              $('.add-mess').remove();
              $('.not-found').remove();
            }
            }
        });
    };
  
$('.search-input').on('keyup',function(event){
  if(event.keyCode == 13){
    $(this).click();
    $input = $('.search-input').val();
    console.log($input);
    $route = '{{route('finddocument')}}';
    $.ajax({
      type: 'get',
      url:$route,
      data:{'search':$input},
      dataType: 'json',
      success:function(data){ 
        console.log(data);
        $('.content').html($('.main-content'));
        $('.content').append(data.html);
      },
      error:function(error){
        console.log(error);
      }
    })
  }
})



</script>