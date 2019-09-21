<?php
require '__admin_required.php';
require "init.php";

$page_name = 'manager_edit';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (empty($sid)) {
    header('Location: admin_backend_list.php');
    exit;
}

$sql = "SELECT * FROM `member_list` WHERE `sid`= $sid";
$sth = $pdo->prepare($sql);
$sth->execute(array(':sid' => $sid));
$row = $pdo->query($sql)->fetch();

if (empty($row)) {
    header('Location: admin_backend_list.php');
    exit;
}
;

?>


<?php require "admin__header.php";?>
<link rel="stylesheet" href="css/index.css">

    <script>
        // css打這裡
    </script>
</head>
<body>
<?php require "admin__nav_bar.php";?>

    <div class="wrapper d-flex">

    <?php require "admin__left_menu.php";?>

        <div class="mainContent">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-10 p-0 mt-5 ml-3 ">
                        <div class="container">
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
                                                <h5 class="card-title">編輯資料</h5>
                                                <form name="form1" onsubmit="return checkForm()">
                                                    <input type="hidden" name="sid" value="<?=$row['sid']?>">
                                                    <div class="form-group" id="identity">
                                                        <input type="checkbox" id="is_company" name="is_company" value="1" <?=$row['is_company'] == 1 ? 'checked' : ''?>>
                                                        <label for="is_company" form-check>吉他代理商</label>
                                                        <input type="checkbox" id="is_teacher" name="is_teacher" value="1" <?=$row['is_teacher'] == 1 ? 'checked' : ''?>>
                                                        <label for="is_teacher" form-check>課程老師</label>
                                                        <input type="checkbox" id="is_hall_owner" name="is_hall_owner" value="1" <?=$row['is_hall_owner'] == 1 ? 'checked' : ''?>>
                                                        <label for="is_hall_owner" form-check>場地租借</label>
                                                        <input type="checkbox" id="is_hire" name="is_hire" value="1" <?=$row['is_hire'] == 1 ? 'checked' : ''?>>
                                                        <label for="is_hire" form-check>徵才廠商</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">名稱</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="<?=htmlentities($row['name'])?>">
                                                        <small id="nameHelp" class="form-text"></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">電子郵箱</label>
                                                        <input type="text" class="form-control" id="email" name="email" value="<?=htmlentities($row['email'])?>">
                                                        <small id="emailHelp" class="form-text"></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">密碼</label>
                                                        <input type="password" class="form-control" id="password" name="password" value="<?=htmlentities($row['password'])?>">
                                                        <small id="passwordHelp" class="form-text"></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="mobile">聯絡電話</label>
                                                        <input type="text" class="form-control" id="tel" name="tel" value="<?=htmlentities($row['tel'])?>">

                                                        <small id="mobileHelp" class="form-text"></small>
                                                    </div>
                                                    <div class="form-group" id="teacher_tel_info" style="display:<?=$row['teacher_tel'] ? 'block' : 'none'?>">
                                                        <label for="mobile" >老師電話</label>
                                                        <input type="text" class="form-control" id="teacher_tel" name="teacher_tel" value="<?=htmlentities($row['teacher_tel'])?>" >
                                                        <small id="teacher_telHelp" class="form-text"></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address">地址</label>
                                                        <div class="d-flex">
                                                            <input type="text" style="width:30%" class="form-control" id="addr_district" name="addr_district" value="<?=htmlentities($row['addr_district'])?>">
                                                            <input type="text" class="form-control" id="addr" name="addr" value="<?=htmlentities($row['addr'])?>">
                                                        </div>
                                                        <small id="addressHelp" class="form-text"></small>
                                                    </div>


                                                    <button type="submit" class="btn btn-primary" id="submit_btn">修改</button>
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
    </div>

<script>


                                    $('#is_teacher').click(function(){
                                        if($('#is_teacher').prop('checked')){
                                        $('#teacher_tel_info').css('display','block')
                                        }else{
                                        $('#teacher_tel_info').css('display','none')
                                        $('#teacher_tel').val('');
                                    }
                                    })

                                    let info_bar = document.querySelector('#info-bar');
                                    const submit_btn = document.querySelector('#submit_btn');
                                    let i, s, item;
                                    // const required_fields = [
                                    //     {
                                    //         id: 'name',
                                    //         pattern: /^\S{2,}/,
                                    //         info: '請填寫正確的姓名'
                                    //     },
                                    //     {
                                    //         id: 'email',
                                    //         pattern: /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i,
                                    //         info: '請填寫正確的 email 格式'
                                    //     },
                                    //     {
                                    //         id: 'mobile',
                                    //         pattern: /^09\d{2}\-?\d{3}\-?\d{3}$/,
                                    //         info: '請填寫正確的手機號碼格式'
                                    //     },
                                    // ];

                                    // 拿到對應的 input element (el), 顯示訊息的 small element (infoEl)
                                    // for(s in required_fields){
                                    //     item = required_fields[s];
                                    //     item.el = document.querySelector('#' + item.id);
                                    //     item.infoEl = document.querySelector('#' + item.id + 'Help');
                                    // }

                                    //   /[A-Z]{2}\d{8}/i  統一發票

                                    // function checkForm(){
                                    //     // 先讓所有欄位外觀回復到原本的狀態
                                    //     for(s in required_fields) {
                                    //         item = required_fields[s];
                                    //         item.el.style.border = '1px solid #CCCCCC';
                                    //         item.infoEl.innerHTML = '';
                                    //     }
                                    //     info_bar.style.display = 'none';
                                    //     info_bar.innerHTML = '';

                                    //     submit_btn.style.display = 'none';

                                    //     // 檢查必填欄位, 欄位值的格式
                                    //     let isPass = true;

                                    //     for(s in required_fields) {
                                    //         item = required_fields[s];

                                    //         if(! item.pattern.test(item.el.value)){
                                    //             item.el.style.border = '1px solid red';
                                    //             item.infoEl.innerHTML = item.info;
                                    //             isPass = false;
                                    //         }
                                    //     }
                                    function checkForm() {
                                            let fd = new FormData(document.form1);
                                            fetch('admin_backend_list_edit_api.php', {
                                                    method: 'POST',
                                                    body: fd,
                                                })
                                                .then(response => {
                                                    return response.json();
                                                })
                                                .then(json => {
                                                    console.log(json);
                                                    submit_btn.style.display = 'block'; // 接受到response後, 按鈕回來
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
                                                        setTimeout(function() {
                                                            location.href = 'admin_backend_list.php';
                                                        }, 1000);
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
                                        return false; // 表單不出用傳統的 post 方式送出
                                        }
</script>

<?php require "admin__footer.php";?>


