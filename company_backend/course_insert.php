<?php
require '__admin_required.php';
require 'init.php';
$page_name = 'course_insert';;

?>
<?php include __DIR__ . '/__header.php' ?>

</head>

<style>
    .fa-user-alt{
        font-size: 25px;
    }

    .fa-hotel{
        font-size: 22px;
    }

    .fa-list-alt{
        font-size: 25px;
    }

    .fa-piggy-bank{
        font-size: 23px;
    }

    .mainContent-css{
        background-color: #F9F9F9;
    }

    .card-css{
        border: none;
        border-radius: 8px;
        box-shadow: 3px 8px 8px #ccc;
    }
    small.form-text {
        color: red;
    }


    .custom-date-style {
	background-color: red !important;
    }

</style>

<body>

<?php include __DIR__ . '/teacher__nav_bar.php' ?>
<div class="wrapper d-flex">
    <?php include 'teacher__left_menu.php' ?>
    <div class="mainContent mainContent-css">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-10 p-0 m-5 ">
                    <div class="container mt-4">
                    <div class="alert alert-primary" role="alert" id="info-bar" style="display: none;width: 50rem;"></div>
                        <div class="card card-css" style="width: 50rem;">
                            <div class="card-body">
                            <h2 class="card-title" style="text-align:center;">新增課程</h2>
                                <!-- <div class="d-flex"></div> -->
                                <form name="form1" onsubmit="return checkForm()"  >
                                                        <div class="form-group">
                                                            <label for="email">帳號（電子信箱）</label>
                                                            <input type="text" class="form-control" id="email" name="email" value="<?= $_SESSION['loginUser']['email']?>" readonly>
                                                            <small id="emailHelp" class="form-text"></small>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="course_name">課程名稱</label>
                                                            <input type="text" class="form-control" id="course_name" name="course_name">
                                                            <small id="course_nameHelp" class="form-text"></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="course_sort">課程類型</label>
                                                            <select id="course_sort" class="form-control" name="course_sort">
                                                                <option selected>彈唱</option>
                                                                <option>指彈</option>
                                                                <option>鄉村</option>
                                                                <option>爵士</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class=" form-group col-md-6">      
                                                                <div class="flatpickr" data-wrap="true" data-click-opens="false">
                                                                    <label for="course_begindate">課程開始日期</label>
                                                                    <input placeholder="Pick date" data-input id="course_begindate" name="course_begindate">
                                                                    <small id="course_begindateHelp" class="form-text"></small>
                                                                    <!-- <a class="input-btn" data-toggle><i class="icon-calendar"></i></a>
                                                                    <a class="input-btn" data-clear><i class="icon-close"></i></a> -->
                                                                </div>   
                                                            </div>

                                                            <div class=" form-group col-md-6">      
                                                                <div class="flatpickr" data-wrap="true" data-click-opens="false">
                                                                    <label for="course_enddate">課程結束日期</label>
                                                                    <input placeholder="Pick date" data-input id="course_enddate" name="course_enddate">
                                                                    <small id="course_enddateHelp" class="form-text"></small>
                                                                </div>   
                                                            </div>
                                                        </div>       
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                    <label for="course_time">課程時間</label>
                                                                <select id="course_time" class="form-control" name="course_time">
                                                                    <option selected value="10:00">10:00~11:00</option>
                                                                    <option value="11:00">11:00~12:00</option>
                                                                    <option value="12:00">12:00~13:00</option>
                                                                    <option value="13:00">13:00~14:00</option>
                                                                    <option value="14:00">14:00~15:00</option>
                                                                    <option value="15:00">15:00~16:00</option>
                                                                    <option value="16:00">16:00~17:00</option>
                                                                    <option value="17:00">17:00~18:00</option>
                                                                    <option value="18:00">18:00~19:00</option>
                                                                    <option value="19:00">19:00~20:00</option>
                                                                    <option value="20:00">20:00~21:00</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="course_person">課程人數</label>
                                                                <select id="course_person" class="form-control" name="course_person">
                                                                    <option selected value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="course_address">上課地點</label>
                                                            <input type="text" class="form-control" id="course_address" name="course_address">
                                                            <small id="course_addressHelp" class="form-text"></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="course_price">課程價格</label>
                                                            <input type="text" class="form-control" id="course_price" name="course_price">
                                                            <small id="course_priceHelp" class="form-text"></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="course_bonus">課程優惠價格</label>
                                                            <input type="text" class="form-control" id="course_bonus" name="course_bonus">
                                                            <small id="course_bonusHelp" class="form-text"></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="course_describe">課程描述</label>
                                                            <input type="text" class="form-control" id="course_describe" name="course_describe" >
                                                            <small id="course_describeHelp" class="form-text"></small>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group">
                                                                
                                                                <input type="file" class="form-control-file" id="course_pic" name="course_pic" style="display: none" onchange="previewFile()" multiple/>
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="button" class="btn btn-info" onclick="selUpload()" >選擇上傳的圖檔</button>
                                                            </div>
                                                            <img src="" height="200" alt="" id="course_img">
                                                            
                                                            <div class="form-group ">
                                                                <button type="submit" class="btn btn-primary" id="submit_btn">確定新增</button>
                                                            </div>
                                                        </div>
                                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>

            <script>
    function selUpload(){
        document.querySelector('#course_pic').click();
    }
    function previewFile() {
            var preview = document.querySelector('#course_img');
            var file    = document.querySelector('input[type=file]').files[0];
            var reader  = new FileReader();

            reader.addEventListener("load", function () {
             preview.src = reader.result;
            }, false);

            if (file) {
             reader.readAsDataURL(file);
            }
            }


//     $("#course_pic").change(function(){
//   $("#course_img").html(""); // 清除預覽
//   readURL(this);
// });

// function readURL(input){
//   if (input.files && input.files.length >= 0) {
//     for(var i = 0; i < input.files.length; i ++){
//       var reader = new FileReader();
//       reader.onload = function (e) {
//         var img = $("<img width='300' height='200'>").attr('src', e.target.result);
//         $("#course_img").append(img);
//       }
//       reader.readAsDataURL(input.files[i]);
//     }
//   }else{
//      var noPictures = $("<p>目前沒有圖片</p>");
//      $("#course_img").append(noPictures);
//   }
// }

    
</script>
    <script>
      
        let info_bar = document.querySelector('#info-bar');
        const submit_btn = document.querySelector('#submit_btn');
        let i, s, item;
        const required_fields = [
            {
                id: 'course_begindate',
                pattern:/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/,
                info: '請填寫正確的 日期 格式'
            },
        ];

        
        for(s in required_fields){
            item = required_fields[s];
            item.el = document.querySelector('#' + item.id);
            item.infoEl = document.querySelector('#' + item.id + 'Help');
        }

        

        function checkForm(){
            
            for(s in required_fields) {
                item = required_fields[s];
                item.el.style.border = '1px solid #CCCCCC';
                item.infoEl.innerHTML = '';
            }
            info_bar.style.display = 'none';
            info_bar.innerHTML = '';

            submit_btn.style.display = 'none';

            
            let isPass = true;

            for(s in required_fields) {
                item = required_fields[s];

                if(! item.pattern.test(item.el.value)){
                    item.el.style.border = '1px solid red';
                    item.infoEl.innerHTML = item.info;
                    isPass = false;
                }
            }

            let fd = new FormData(document.form1);

            if(isPass) {
                fetch('course_insert_api.php', {
                    method: 'POST',
                    body: fd,
                })
                    .then(response => {
                        return response.json();
                    })
                    .then(json => {
                        console.log(json);
                        submit_btn.style.display = 'block';
                        info_bar.style.display = 'block';
                        info_bar.innerHTML = json.info;
                        if (json.success) {
                            info_bar.className = 'alert alert-success';
                            setTimeout(function(){
                               document.location.href="course_list.php"
                            },1000);

                        } else {
                            info_bar.className = 'alert alert-danger';
                        }
                    });
            } else {
                submit_btn.style.display = 'block';
            }
            return false; 
        }



    </script>

<?php require_once __DIR__ . "/__footer.php"; ?>