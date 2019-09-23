<?php
require '__admin_required.php';
require 'init.php';
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "SELECT * FROM `member_list` WHERE `sid`=$sid";
$stmt = $pdo->query($sql);
$row = $stmt->fetch();

// echo '<pre>',print_r($_SESSION),'</pre>';

include 'admin__header.php';
include 'admin__nav_bar.php';
?>
</head>

<style>
    .table th {
        width: 20%;
    }

    .table td {
        vertical-align: middle;
        color: #6c757d;
    }

    textarea {
        width: 60%;
        height: 200px;
        resize: none;
    }

    input {
        width: 60%;
    }
    .breadcrumb-item a{
        color: rgb(226, 24, 24);
    }
</style>


<body>

<div class="wrapper d-flex">

<?php require 'admin__left_menu.php'?>

<div class="mainContent mainContent-css">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-11 mt-5 mx-auto">

                        <div class="alert alert-primary" role="alert" id="info-bar" style="display: none"></div>
                        <div style="margin-top: 2rem;">

                            <div class="container">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-3 p-1">
                                        <li class="breadcrumb-item"><a href="admin_hall_list.php">場地廠商列表</a></li>
                                        <li class="breadcrumb-item active font-weight-bold" aria-current="page">編輯廠商資訊
                                        </li>
                                    </ol>
                                </nav>
                                <div class="card edit_card" style="width: 50rem;">
                                    <div class="card-body card-body-css">
                                        <form name="form1" onsubmit="return checkForm()">
                                            <input type="hidden" name="sid" value="<?=$row['sid']?>">
                                            <table class="table table-hover">
                                                <tr>
                                                    <th style="border-top: 0px;">廠商名稱</th>
                                                    <td style="border-top: 0px;"><?=$row['name']?></td>
                                                </tr>
                                                <tr>
                                                    <th>密碼</th>
                                                    <td>
                                                        <input type="password" name="password" id="password"
                                                            value="<?=$row['password']?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>統一編號</th>
                                                    <td><?=$row['tax_id']?></td>
                                                </tr>
                                                <tr>
                                                    <th>L O G O</th>
                                                    <td>
                                                        <form name="form1" method="post" enctype="multipart/form-data">
                                                            <img src="uploads/<?=$row['pic']?>" alt="" class=""
                                                                id="hall_pic_pre" style="width:50%;">
                                                            <input type="file" class="form-control-file" id="my_file"
                                                                name="my_file" onchange="previewFile()">
                                                        </form>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <th>詳細地址</th>
                                                    <td class="">
                                                        <input type="text" name="addr_district" id="addr_district"
                                                            value="<?=$row['addr_district']?>">
                                                        <br>
                                                        <input type="text" name="addr" id="addr" class="mt-1"
                                                            value="<?=$row['addr']?>">
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <th>官方網站</th>
                                                    <td><input type="text" name="hall_web" id="hall_web"
                                                            value="<?=$row['hall_web']?>"></td>

                                                </tr>
                                                <tr>
                                                    <th>
                                                        <label for="tel">聯絡電話</label>
                                                    </th>
                                                    <td>
                                                        <input type="text" name="tel" id="tel" value="<?=$row['tel']?>">
                                                        <a href="" id="addBtn_1"><i class="fas fa-plus"></i></a>
                                                        <br>
                                                        <input type="<?=!empty($row['alt_tel']) ? 'text' : 'hidden'?>"
                                                            name="alt_tel" id="alt_tel" class="mt-1"
                                                            value="<?=$row['alt_tel']?>">
                                                        <a href=""
                                                            style="<?=!empty($row['alt_tel']) ? 'display:inline-block' : 'display: none'?>"
                                                            id="removeBtn_1"><i class="fas fa-minus"></i></a>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <th>
                                                        <label for="email">電子信箱</label>
                                                    </th>
                                                    <td>
                                                        <?=$row['email']?>
                                                        <a href="" id="addBtn_2"><i
                                                                class="fas fa-plus ml-1"></i></a><br>
                                                        <input type="<?=!empty($row['alt_email']) ? 'text' : 'hidden'?>"
                                                            name="alt_email" id="alt_email" class="mt-1"
                                                            value="<?=$row['alt_email']?>">
                                                        <a href=""
                                                            style="<?=!empty($row['alt_email']) ? 'display:inline-block' : 'display: none'?>"
                                                            id="removeBtn_2"><i class="fas fa-minus"></i></a>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <th><label for="bank_acc">銀行戶名</label></th>
                                                    <td><input type="text" name="bank_acc" id="bank_acc"
                                                            value="<?=$row['bank_acc']?>"></td>

                                                </tr>
                                                <tr>
                                                    <th><label for="bank_num">帳戶號碼</label></th>
                                                    <td><input type="text" name="bank_num" id="bank_num"
                                                            value="<?=$row['bank_num']?>"></td>

                                                </tr>
                                                <tr>
                                                    <th>場地介紹</th>
                                                    <td><textarea name="hall_introduce"
                                                            id="hall_introduce"><?=$row['hall_introduce']?></textarea>
                                                    </td>

                                                </tr>

                                            </table>
                                            <button type="submit" class="btn btn-dark" id="submit_btn">修改</button>
                                            <a href="admin_hall_list.php">
                                                <div type="" class="btn btn-light ml-2" id="">取消 </div>
                                            </a>

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

        // tel + -
        // let addBtn_1 = document.querySelector('#addBtn_1');
        // let removeBtn_1 = document.querySelector('#removeBtn_1');
        // let input_1 = document.querySelector('#alt_tel');
        // addBtn_1.addEventListener('click', function (e) {
        //     e.preventDefault();
        //     input_1.setAttribute('type', 'text');
        //     removeBtn_1.style = 'block';
        // })

        // removeBtn_1.addEventListener("click", function (e) {
        //     if (confirm('確定要刪除這筆資料嗎?')) {
        //         e.preventDefault();
        //         input_1.setAttribute('type', 'hidden');
        //         removeBtn_1.style.display = "none";
        //         input_1.value = "<?=$row['alt_tel'] = ''?>";
        //     }
        // })

        //--------
        // tel + -　用jQuery寫＆加動畫
        $("#addBtn_1").click(function (e) {
            e.preventDefault()
            $("#alt_tel").removeClass("animated fadeOutUp").addClass("animated fadeInDown mt-1").attr("type", "text")
            $("#removeBtn_1").show()
        })

        $("#removeBtn_1").click(function (e) {
            e.preventDefault()
            confirm("確定要刪除這筆電話資料嗎？")
            $("#alt_tel").removeClass("animated fadeInDown").addClass("animated fadeOutUp").attr("type", "hidden").attr("value", "<?=$row['alt_tel'] = ''?>")
            $(this).hide()
        })


        // email + -
        // let addBtn_2 = document.querySelector('#addBtn_2');
        // let removeBtn_2 = document.querySelector('#removeBtn_2');
        // let input_2 = document.querySelector('#alt_email');
        // addBtn_2.addEventListener('click', function (e) {
        //     e.preventDefault();
        //     input_2.setAttribute('type', 'text');
        //     removeBtn_2.style = 'block';
        // })

        // removeBtn_2.addEventListener("click", function (e) {
        //     if (confirm('確定要刪除這筆資料嗎?')) {
        //         e.preventDefault();
        //         input_2.setAttribute('type', 'hidden');
        //         removeBtn_2.style.display = "none";
        //         input_2.value = "<?=$row['alt_email'] = ''?>";
        //     }
        // })

        //--------
        // email + -　用jQuery寫＆加動畫
        $("#addBtn_2").click(function (e) {
            e.preventDefault()
            $("#alt_email").removeClass("animated fadeOutUp").addClass("animated fadeInDown mt-1").attr("type", "text")
            $("#removeBtn_2").show()
        })

        $("#removeBtn_2").click(function (e) {
            e.preventDefault()
            confirm("確定要刪除這筆電子信箱資料嗎？")
            $("#alt_email").removeClass("animated fadeInDown").addClass("animated fadeOutUp").attr("type", "hidden").attr("value", "<?=$row['alt_email'] = ''?>")
            $(this).hide()
        })


            // 預覽上傳圖片
            function previewFile() {
              var preview = document.querySelector('#hall_pic_pre');
              var file    = document.querySelector('input[type=file]').files[0];
              var reader  = new FileReader();

              reader.addEventListener("load", function () {
                preview.src = reader.result;
              }, false);

              if (file) {
                reader.readAsDataURL(file);
              }
            };


            let info_bar = document.querySelector('#info-bar');

            function checkForm() {
                let fd = new FormData(document.form1);
                fetch('admin_hall_edit_api.php', {
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
                            // info_bar.style.display = 'block';
                            // info_bar.innerHTML = json.info;
                            // info_bar.className = 'alert alert-success';
                            // location.href = 'hall_index.php';
                            Swal.fire({
                            type: 'success',
                            title: json.info,
                            showConfirmButton: false,
                            timer: 1500
                            })
                            setTimeout(function() {
                                location.href = 'admin_hall_list.php';
                            }, 1000);
                        } else {
                            // info_bar.style.display = 'block';
                            // info_bar.innerHTML = json.info;
                            // info_bar.className = 'alert alert-danger';
                            Swal.fire({
                            type: 'error',
                            title: json.info,
                            showConfirmButton: false,
                            timer: 1500
                            })
                        }
                    });
                return false;
            };
</script>




<?php require 'admin__footer.php'?>