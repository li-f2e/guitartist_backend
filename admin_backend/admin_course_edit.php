<!-- <?php require '__admin_required.php'; ?> -->
<!-- 可以改成自己的連結黨 -->
<?php require_once __DIR__ . "/init.php"; ?>    
<?php
  $page_name = 'course_edit';
  $page_title = '編輯資料';
  
  $sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
  if(empty($sid)) {
      header('Location: course_list.php');
      exit;
  }
  
  $sql = "SELECT * FROM `course_tb` WHERE `sid`=$sid";
  $row = $pdo->query($sql)->fetch();
  if(empty($row)) {
      header('Location: course_list.php');
      exit;
  }
?>   
<?php require_once __DIR__ . "/admin__header.php"; ?>
<link rel="stylesheet" href="css/index.css">

    <script>
        // css打這裡
    </script>
</head>
<body>
<?php require_once __DIR__ . "/admin__nav_bar.php"; ?>

    <div class="wrapper d-flex">
        
    <?php require_once __DIR__ . "/admin__left_menu.php"; ?>
    
        <div class="mainContent">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-10 p-0 mt-5 ml-3 ">
                    <div style="margin-top: 2rem;">
    <div class="row">
        <div class="col">
            <div class="alert alert-primary" role="alert" id="info-bar" style="display: none"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">編輯課程</h5>
                    <form name="form1" onsubmit="return checkForm()">
                    <input type="hidden" name="sid" value="<?= $row['sid'] ?>">
                    <div class="form-group">
                            <label for="email">帳號（電子信箱）</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= htmlentities($row['email']) ?>" readonly>
                            <small id="emailHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="course_name">課程名稱</label>
                            <input type="text" class="form-control" id="course_name" name="course_name" value="<?= htmlentities($row['course_name']) ?>">
                            <small id="course_nameHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="course_sort">課程類型</label>
                            <select id="course_sort" class="form-control" name="course_sort" value="<?= htmlentities($row['course_sort']) ?>">
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
                                    <input placeholder="Pick date" data-input id="course_begindate" name="course_begindate" value="<?= htmlentities($row['course_begindate']) ?>">
                                    <small id="course_begindateHelp" class="form-text"></small>
                                    <!-- <a class="input-btn" data-toggle><i class="icon-calendar"></i></a>
	                                <a class="input-btn" data-clear><i class="icon-close"></i></a> -->
                                </div>   
                            </div>

                            <div class=" form-group col-md-6">      
                                <div class="flatpickr" data-wrap="true" data-click-opens="false">
                                    <label for="course_enddate">課程結束日期</label>
                                    <input placeholder="Pick date" data-input id="course_enddate" name="course_enddate" value="<?= htmlentities($row['course_enddate']) ?>">
                                    <small id="course_enddateHelp" class="form-text"></small>
                                </div>   
                            </div>
                        </div> 
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                    <label for="course_time">課程時間</label>
                                <select id="course_time" class="form-control" name="course_time" value="<?= htmlentities($row['course_time']) ?>">
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
                            <select id="course_person" class="form-control" name="course_person" value="<?= htmlentities($row['course_person']) ?>">
                                <option selected value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="course_address">上課地點</label>
                            <input type="text" class="form-control" id="course_address" name="course_address" value="<?= htmlentities($row['course_address']) ?>">
                            <small id="course_addressHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="course_price">課程價格</label>
                            <input type="text" class="form-control" id="course_price" name="course_price" value="<?= htmlentities($row['course_price']) ?>">
                            <small id="course_priceHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="course_bonus">課程優惠價格</label>
                            <input type="text" class="form-control" id="course_bonus" name="course_bonus" value="<?= htmlentities($row['course_bonus']) ?>">
                            <small id="course_bonusHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="course_describe">課程描述</label>
                            <input type="text" class="form-control" id="course_describe" name="course_describe" value="<?= htmlentities($row['course_describe']) ?>">
                            <small id="course_describeHelp" class="form-text"></small>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                
                                <input type="file" class="form-control-file" id="course_pic" name="course_pic" style="display: none" onchange="previewFile()" >
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-info" onclick="selUpload()" >選擇上傳的圖檔</button>
                            </div>
                            
                            <img class="course_pic" src="uploads/<?=$row['course_pic']?>" alt="" height="200">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="submit_btn">確定修改</button>
                            </div>
                        </div>
                        


                        <!-- <button type="submit" class="btn btn-primary" id="submit_btn">修改</button> -->
                    </form>
                </div>
            </div>

        </div>
    </div>






</div>


    <script>
        
        function selUpload(){
            document.querySelector('#course_pic').click();
        }
        //圖片預覽
        function previewFile() {
                var preview = document.querySelector('img');
                var file    = document.querySelector('input[type=file]').files[0];
                var reader  = new FileReader();

                reader.addEventListener("load", function () {
                preview.src = reader.result;
                }, false);

                if (file) {
                reader.readAsDataURL(file);
                }
                }
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

        // 拿到對應的 input element (el), 顯示訊息的 small element (infoEl)
        for(s in required_fields){
            item = required_fields[s];
            item.el = document.querySelector('#' + item.id);
            item.infoEl = document.querySelector('#' + item.id + 'Help');
        }

        //   /[A-Z]{2}\d{8}/i  統一發票

        function checkForm(){
            // 先讓所有欄位外觀回復到原本的狀態
            for(s in required_fields) {
                item = required_fields[s];
                item.el.style.border = '1px solid #CCCCCC';
                item.infoEl.innerHTML = '';
            }
            info_bar.style.display = 'none';
            info_bar.innerHTML = '';

            submit_btn.style.display = 'none';

            // 檢查必填欄位, 欄位值的格式
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
                fetch('course_edit_api.php', {
                    method: 'POST',
                    body: fd,
                })
                    .then(response => {
                        return response.json();
                    })
                    .then(json => {
                        console.log(json);
                        submit_btn.style.display = 'block';
                        // info_bar.style.display = 'block';
                        // info_bar.innerHTML = json.info;
                        if (json.success) {
                            // info_bar.className = 'alert alert-success';
                            Swal.fire({
                            type: 'success',
                            title: json.info,
                            showConfirmButton: false,
                            timer: 1500
                            })
                            setTimeout(function(){
                               document.location.href="course_list.php"
                            },1000);

                        } else {
                            // info_bar.className = 'alert alert-danger';
                            Swal.fire({
                            type: 'error',
                            title: json.info,
                            showConfirmButton: false,
                            timer: 1500
                            })
                        }
                    });
            } else {
                submit_btn.style.display = 'block';
            }
            return false; 
        }



    </script>
</div>
    </div>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
// js打這裡
</script>

<?php require_once __DIR__ . "/admin__footer.php"; ?>

