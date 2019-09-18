<?php
require '__admin_required.php';
require 'init.php';
$page_name = 'data_insert';
$page_title = '新增資料';

?>
<?php require 'admin__header.php'?>

<?php require "admin__nav_bar.php"?>

    <div class="wrapper d-flex">

    <?php require "admin__left_menu.php";?>

        <div class="mainContent">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-10 p-0 mt-5 ml-3 ">
                        <div class="container">
<div style="margin-top: 2rem;">

    <div class="row">

        <div class="alert alert-primary" role="alert" id="info-bar" style="display: none"></div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增老師資料</h5>
                    <form name="form1" onsubmit="return checkForm()">
                        <div class="form-group">
                            <label for="teacher_pic">照片</label>
                            <img  id="img" style="width:200px" src="" alt="">
                            <input type="file" class="form-control" id="my_file" name="my_file" onchange="previewFile()">
                            <small id="my_fileHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="teacher_name">名字</label>
                            <input type="text" class="form-control" id="teacher_name" name="teacher_name">
                            <small id="nameHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="teacher_birthday">生日</label>
                            <input type="text" class="form-control" id="teacher_birthday" name="teacher_birthday" value="2000-03-03">
                            <small id="teacher_birthdayHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="teacher_specialty">專長</label>
                            <input type="text" class="form-control" id="teacher_specialty" name="teacher_specialty">
                            <small id="teacher_specialtyHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="teacher_introduction">自我介紹</label>
                            <input type="text" class="form-control" id="teacher_introduction" name="teacher_introduction">
                            <small id="teacher_introductionHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="email">電子郵件</label>
                            <input type="text" class="form-control" id="email" name="email">
                            <small id="emailHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="teacher_tel">聯絡電話</label>
                            <input type="text" class="form-control" id="teacher_tel" name="teacher_tel">
                            <small id="telHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="teacher_experience">教學經歷</label>
                            <input type="text" class="form-control" id="teacher_experience" name="teacher_experience">
                            <small id="teacher_experienceHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="teacher_perform">表演經歷</label>
                            <input type="text" class="form-control" id="teacher_perform" name="teacher_perform">
                            <small id="teacher_performHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="teacher_award">得獎紀錄</label>
                            <input type="text" class="form-control" id="teacher_award" name="teacher_award">
                            <small id="teacher_awardHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="teacher_music">作品影音</label>
                            <input type="text" class="form-control" id="teacher_music" name="teacher_music">
                            <small id="teacher_musicHelp" class="form-text"></small>
                        </div>


                        <button type="submit" class="btn btn-primary" id="submit_btn">新增</button>
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
    </div>


    <script>
        let info_bar = document.querySelector('#info-bar');
        const submit_btn = document.querySelector('#submit_btn');
        let i, s, item;


            // 圖片顯示
            function previewFile() {
            var preview = document.querySelector('#img');
            var file    = document.querySelector('input[type=file]').files[0];
            var reader  = new FileReader();

            reader.addEventListener("load", function () {
             preview.src = reader.result;
            }, false);

            if (file) {
             reader.readAsDataURL(file);
            }
            }
        // TODO: 檢查必填欄位, 欄位值的格式
            const required_fields = [
            {
                id: 'name',
                pattern: /^\S{2,}/,
                info: '請填寫正確的姓名'
            },
            {
                id: 'email',
                pattern: /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i,
                info: '請填寫正確的 email 格式'
            },
            {
                id: 'tel',
                pattern: /^09\d{2}\-?\d{3}\-?\d{3}$/,
                info: '請填寫正確的手機號碼格式'
            },
            {
                id: 'my_file',
                pattern: /^\:/,
                info: '請選擇圖片'
            }

        ];
        // 拿到對應的 input element (el), 顯示訊息的 small element (infoEl)
        for(s in required_fields){
            item = required_fields[s];
            item.el = document.querySelector('#' + item.id);
            item.infoEl = document.querySelector('#' + item.id + 'Help');
        }


        function checkForm(){
            // TODO: 檢查必填欄位, 欄位值的格式
            for(s in required_fields) {
                item = required_fields[s];
                console.log(s);
                console.log(item);
                item.el.style.border = '1px solid #CCCCCC';
                item.infoEl.innerHTML = '';
            }
            info_bar.style.display = 'none';
            info_bar.innerHTML = '';

            submit_btn.style.display = 'none';
            let isPass = true;

            for(s in required_fields) {
                item = required_fields[s];

                console.log(item.el.value);
                if(! item.pattern.test(item.el.value)){
                    item.el.style.border = '1px solid red';
                    item.infoEl.innerHTML = item.info;
                    isPass = false;
                }

            }

            if(isPass){

            let fd = new FormData(document.form1);

            fetch('admin_teacher_insert_api.php', {
                method: 'POST',
                body: fd,
            })
                .then(response=>{
                    return response.json();
                })
                .then(json=>{
                    console.log(json);
                    info_bar.style.display = 'block';
                    info_bar.innerHTML = json.info;
                    if(json.success){
                        info_bar.className = 'alert alert-success';
                    } else {
                        info_bar.className = 'alert alert-danger';
                    }
                });
            }else {
                submit_btn.style.display = 'block';
            }
            return false; // 表單不出用傳統的 post 方式送出
        }



    </script>
</div>
<?php include 'admin__footer.php'?>