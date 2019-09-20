<?php // require '__admin_required.php'; ?>
<!-- 可以改成自己的連結黨 -->
<?php require_once __DIR__ . "/init.php"; ?>    
<?php
  $page_name = 'job_list';
  $page_title = '編輯資料';
  
  $sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
  if(empty($sid)) {
      header('Location: admin_job_list.php');
      exit;
  }
  
  $sql = "SELECT * FROM `job_list` WHERE `sid`=$sid";
  $row = $pdo->query($sql)->fetch();
  if(empty($row)) {
      header('Location: admin_job_list.php');
      exit;
  }
?>   
<?php require_once __DIR__ . "/admin__header.php"; ?>
<?php require_once __DIR__ . "/admin__nav_bar.php"; ?>
<link rel="stylesheet" href="css/index.css">

    <script>
        // css打這裡
    </script>
</head>
<body>


    <div class="wrapper d-flex">
        
    <?php require_once __DIR__ . "/admin__left_menu.php"; ?>
    
        <div class="mainContent">
            <div class="container-fluid">
                <div class="row justify-content-start">
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
                    <h5 class="card-title">編輯職缺</h5>
                    <form name="form1" onsubmit="return checkForm()">
                    <input type="hidden" name="sid" value="<?= $row['sid'] ?>">
                    <div class="form-group">
                            <label for="email">帳號（電子信箱）</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= htmlentities($row['email']) ?>" readonly>
                            <small id="emailHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="job_name">職缺名稱</label>
                            <input type="text" class="form-control" id="job_name" name="job_name" value="<?= htmlentities($row['job_name']) ?>">
                            <small id="job_nameHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="job_class">職缺類型</label>
                            <select id="job_class" class="form-control" name="job_class" value="<?= htmlentities($row['job_class']) ?>">
                                <option <?php if($row['job_class'] == "表演駐唱"){ ?> selected <?php } ?>>表演駐唱</option>
                                <option <?php if($row['job_class'] == "樂團吉他手"){ ?> selected <?php } ?>>樂團吉他手</option>
                                <option <?php if($row['job_class'] == "社團老師招募"){ ?> selected <?php } ?>>社團老師招募</option>
                                <option <?php if($row['job_class'] == "吉他音樂創作"){ ?> selected <?php } ?>>吉他音樂創作</option>
                                <option <?php if($row['job_class'] == "其他"){ ?> selected <?php } ?>>其他</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="job_introduce">職缺內容</label>
                            <input type="text" class="form-control" id="job_introduce" name="job_introduce" value="<?= htmlentities($row['job_introduce']) ?>">
                            <small id="job_introduceHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="job_experience">經驗</label>
                            <input type="text" class="form-control" id="job_experience" name="job_experience" value="<?= htmlentities($row['job_experience']) ?>">
                            <small id="job_experienceHelp" class="form-text"></small>
                        </div>
                        
                        <div class="form-group" ></div>
                        <label for="job_pay">新資</label>
                        <div class="form-row">
                            
                            <div class="form-group col-md-5">
                            <input type="text" class="form-control" id="job_pay" name="job_pay" value="<?= htmlentities($row['job_pay']) ?>">
                            <small id="job_payHelp" class="form-text"></small>   

                            </div>
                            <div class="form-group ">~</div>

                        <div class="form-group col-md-5">
                            
                            <input type="text" class="form-control" id="job_pay_up" name="job_pay_up" value="<?= htmlentities($row['job_pay_up']) ?>">
                            <small id="job_pay_upHelp" class="form-text"></small>
                        </div>
                        新台幣
                        </div>

                        <div class="form-group">
                            <label for="job_num">需求人數</label>
                            <input type="text" class="form-control" id="job_num" name="job_num" value="<?= htmlentities($row['job_num']) ?>">
                            <small id="job_numHelp" class="form-text"></small>
                        </div>

                        <div class="form-group">
                            <label for="job_full-part">全職/兼職</label>
                            <select id="job_full-part" class="form-control" name="job_full-part" value="<?= htmlentities($row['job_full-part']) ?>">
                            <?php if( $row['job_full-part'] == "全職"){?>
                                <option selected>全職</option>
                                <option>兼職</option>
                            <?php }else{?>
                                <option>全職</option>
                                <option selected>兼職</option>
                            <?php }?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="job_urgent">急徵</label>
                            <?php if($row['job_urgent'] =="是"){?>
                            <input  type="radio" name="job_urgent" value="是" checked>是
                            <input  type="radio" name="job_urgent" value="否">否
                            <?php  }else{ ?>
                                <input  type="radio" name="job_urgent" value="是" >是
                            <input  type="radio" name="job_urgent" value="否" checked>否
                            <?php } ?>
                            <!-- <select id="job_urgent" class="form-control" name="job_urgent" value="<?//= htmlentities($row['job_urgent']) ?>">
                                <option>是</option>
                                <option >否</option>
                            </select> -->

                        </div>
                        
                        
                        <div class="form-row">
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
        // const required_fields = [
        //     {
        //         id: 'course_begindate',
        //         pattern:/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/,
        //         info: '請填寫正確的 日期 格式'
        //     },
        // ];

        // // 拿到對應的 input element (el), 顯示訊息的 small element (infoEl)
        // for(s in required_fields){
        //     item = required_fields[s];
        //     item.el = document.querySelector('#' + item.id);
        //     item.infoEl = document.querySelector('#' + item.id + 'Help');
        // }

        //   /[A-Z]{2}\d{8}/i  統一發票

        //連資料庫
        function checkForm() {
                let fd = new FormData(document.form1);
                fetch('admin_job_edit_api.php', {
                        method: 'POST',
                        body: fd,
                    })
                    .then(response => {
                        return response.json();
                    })
                    .then(json => {
                        console.log(json);
                        submit_btn.style.display = 'block'; // 接受到response後, 按鈕回來
                        info_bar.style.display = 'block';
                        info_bar.innerHTML = json.info;
                        if (json.success) {
                            info_bar.className = 'alert alert-success';
                            setTimeout(function() {
                                location.href = 'admin_job_edit.php?sid=' + <?=$sid?>; 
                            }, 1000);
                        } else {
                            info_bar.className = 'alert alert-danger';
                        }
                    });
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

<?php require_once __DIR__ . "/__footer.php"; ?>