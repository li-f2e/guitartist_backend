<?php
require '__admin_required.php';
require 'init.php';
$sql = "SELECT * FROM member_list WHERE email = ?;";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['loginUser']['email']]);
$row = $stmt->fetch();

// echo '<pre>',print_r($_SESSION),'</pre>';

?>

<?php require '__header.php' ?>
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

.hall_edit_card{
    border: none;
}

.table th{
    width: 20%;
}
.table td{
    vertical-align: middle;
    color : #6c757d;
}
.fa-plus ,.fa-minus{
    font-size: 15px;
}

.fa-edit{
    font-size: 20px
}

textarea{
    width:60%; 
    height:200px;
    resize:none;
}

input{
    width: 60%;
}

.mainContent-css{
    background-color: #F9F9F9;
}


</style>


<body>
<?php require '__hall__nav_bar.php' ?>

<div class="wrapper d-flex">

<?php require '__hall__left_menu.php' ?>

    <div class="mainContent">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-10 p-0 m-5 ">
                <div class="alert alert-primary" role="alert" id="info-bar" style="display: none"></div>
                <div style="margin-top: 2rem;">
                <div class="container mt-4">
                <div class="card hall_edit_card">
                <div class="card-body">
                <form name="form1" onsubmit="return checkForm()" style="width: 50rem;">
                        <input type="hidden" name="sid" value="<?= $row['sid'] ?>">
                        <table class="table table-hover">
                            <tr>
                                <th>廠商名稱</th>
                                <td><?= $row['name'] ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>統一編號</th>
                                <td><?= $row['tax_id'] ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>L O G O</th>
                                <td>
                                <form name="form1" method="post" enctype="multipart/form-data">
                                    <img src="uploads/<?= $row['pic'] ?>" alt="" class="" style="width:70%;">
                                    <input type="file" class="form-control-file" id="my_file" name="my_file" onchange="previewFile()">
                                </form>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>詳細地址</th>
                                <td><input type="text" name="addr" id="addr" value="<?= $row['addr'] ?>"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>官方網站</th>
                                <td><input type="text" name="hall_web" id="hall_web" value="<?= $row['hall_web'] ?>"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>
                                    <label for="tel">聯絡電話</label>
                                </th>
                                <td>
                                    <input type="text" name="tel" id="tel" value="<?= $row['tel'] ?>">
                                    <a href="" id="addBtn_1"><i class="fas fa-plus"></i></a><br>
                                    <input type="<?= !empty($row['alt_tel']) ? 'text' : 'hidden' ?>" name="alt_tel" id="alt_tel" value="<?= $row['alt_tel'] ?>">
                                    <a href="" style="<?= !empty($row['alt_tel']) ? 'display:inline-block' : 'display: none' ?>" id="removeBtn_1"><i class="fas fa-minus"></i></a>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>
                                    <label for="email">電子信箱</label>
                                </th>
                                <td>
                                    <?= $row['email'] ?>
                                    <a href="" id="addBtn_2"><i class="fas fa-plus ml-1"></i></a><br>
                                    <input type="<?= !empty($row['alt_email']) ? 'text' : 'hidden' ?>" name="alt_email" id="alt_email" value="<?= $row['alt_email'] ?>">
                                    <a href="" style="<?= !empty($row['alt_email']) ? 'display:inline-block' : 'display: none' ?>" id="removeBtn_2"><i class="fas fa-minus"></i></a>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <th><label for="bank_acc">銀行戶名</label></th>
                                <td><input type="text" name="bank_acc" id="bank_acc" value="<?= $row['bank_acc'] ?>"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th><label for="bank_num">帳戶號碼</label></th>
                                <td><input type="text" name="bank_num" id="bank_num" value="<?= $row['bank_num'] ?>"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>場地介紹</th>
                                <td><textarea name="hall_introduce" id="hall_introduce"><?= $row['hall_introduce'] ?></textarea></td>
                                <td></td>
                            </tr>

                        </table>
                        <button type="submit" class="btn btn-primary" id="submit_btn">修改</button>
                        <a href="hall_owner_info.php"><div type="" class="btn btn-light" id="">取消 </div></a>
                       
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
            let addBtn_1 = document.querySelector('#addBtn_1');
            let removeBtn_1 = document.querySelector('#removeBtn_1');
            let input_1 = document.querySelector('#alt_tel');
            addBtn_1.addEventListener('click', function(e) {
                e.preventDefault();
                input_1.setAttribute('type', 'text');
                removeBtn_1.style = 'block';
            })

            removeBtn_1.addEventListener("click", function(e) {
                if (confirm('確定要刪除這筆資料嗎?')) {
                    e.preventDefault();
                    input_1.setAttribute('type', 'hidden');
                    removeBtn_1.style.display = "none";
                    input_1.value = "<?= $row['alt_tel'] = '' ?>";
                }
            })
            
            
            // email + -
            let addBtn_2 = document.querySelector('#addBtn_2');
            let removeBtn_2 = document.querySelector('#removeBtn_2');
            let input_2 = document.querySelector('#alt_email');
            addBtn_2.addEventListener('click', function(e) {
                e.preventDefault();
                input_2.setAttribute('type', 'text');
                removeBtn_2.style = 'block';
            })

            removeBtn_2.addEventListener("click", function(e) {
                if (confirm('確定要刪除這筆資料嗎?')) {
                    e.preventDefault();
                    input_2.setAttribute('type', 'hidden');
                    removeBtn_2.style.display = "none";
                    input_2.value = "<?= $row['alt_email'] = '' ?>";
                }
            })


            // 預覽上傳圖片
            function previewFile() {
              var preview = document.querySelector('img');
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
                fetch('hall_edit_api.php', {
                        method: 'POST',
                        body: fd,
                    })
                    .then(response => {
                        return response.json();
                    })
                    .then(json => {
                        console.log(json);
                        // submit_btn.style.display = 'block'; // 接受到response後, 按鈕回來
                        info_bar.style.display = 'block';
                        info_bar.innerHTML = json.info;
                        if (json.success) {
                            // info_bar.style.display = 'block';
                            // info_bar.innerHTML = json.info;
                            info_bar.className = 'alert alert-success';
                            // location.href = 'hall_index.php';
                            setTimeout(function() {
                                location.href = 'hall_owner_info.php'; 
                            }, 1000);
                        } else {
                            // info_bar.style.display = 'block';
                            // info_bar.innerHTML = json.info;
                            info_bar.className = 'alert alert-danger';
                        }
                    });
                return false;
            };
</script>




<?php require '__footer.php' ?>