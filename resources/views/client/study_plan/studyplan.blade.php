<meta name="viewport" content="width=device-width, initial-scale=1">

@include('layout.header')
<div class="body">
        @include('layout.menu')
        @include('layout.chatbox')
        <div class="studyplan-content">
            <div class="table-Khoa-Major">
                <h4>Khoa Đào Tạo</h4>
                <div class="list-khoa">  
                    <ul>
                        @foreach($khoas as $khoa)
                        <li class="list-name"><a href="">{{$khoa->Khoa_Name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="table-Khoa-Major">
             <h4>Ngành Đào Tạo</h4>
                <div class="list-major">
                    <ul>
                        @foreach($majors as $major)
                        <li class="list-name" value="{{$major->id}}"><a href="#">{{$major->Major_Name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="table-studyplan">
        </div>
        <footer class="art-footer">
        <div class="art-nostyle">
        <div class="custom">
            <p style="margin-top: 0px; margin-bottom: 0px; text-align: right;" align="center"><span style="font-size: 10pt; font-family: Arial;">Cập nhật:&nbsp;Trường Đại học Cần Thơ (Can Tho University)<br></span></p></div>
        </div>
        </footer>
</div>
<script>
    $(document).ready(function(){
        $('.list-name').click(function(){
            $major_id = $(this).val();
            console.log($major_id);
            let route = '{{route('detail-studyplan')}}';
            $.ajax({
                url:route,
                type: 'GET',
                data:{
                    major_id:$major_id
                },
                dataType:'json',
                success:function(data){
                    console.log(data);
                    $('.table-studyplan').html("");
                    $('.table-studyplan').append(
                        `<h4>${data.infor_major_khoa[0].Khoa_Name} - Ngành ${data.infor_major_khoa[0].Major_Name} - MÃ NGÀNH : ${data.infor_major_khoa[0].Major_Code}</h4>
                            <table class="table table-bordered" id="customers">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Mã Học Phần</th>
                                        <th scope="col">Tên Học Phần</th>
                                        <th scope="col">Số Tín Chỉ</th>
                                    </tr>
                                </thead>
                            </table>
                        `);
                        if(data.study_plans.length > 0){
                            $sum = 0;
                            for(let i = 0; i < data.study_plans.length; i++){
                                $sum += data.study_plans[i].number_of_credits;
                                $('.table-bordered').append(
                                    `<tr>
                                        <td>${i+1}</td>
                                        <td>${data.study_plans[i].course_code}</td>
                                        <td> <a href="#">${data.study_plans[i].course_name}</a></td>
                                        <td>${data.study_plans[i].number_of_credits}</td>
                                    </tr>
                                    `
                                )
                            }
                        }
                        else{
                            $('.table-studyplan').append(
                                `<h4>Không có dữ liệu</h4>
                                `
                            )
                        }
                },
                error:function(error){
                    console.log(error);
                }

            })
        })
    })
</script>