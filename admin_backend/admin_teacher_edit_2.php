<?php
require '__admin_required.php';
require 'init.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "SELECT * FROM `member_list` WHERE `sid`=$sid ";
$stmt = $pdo->query($sql);
$row = $stmt->fetch();

// echo '<pre>', print_r($row['alt_email']), '</pre>';

?>
<?php
require 'admin__header.php';
require "admin__nav_bar.php";
?>

<div class="wrapper d-flex">

    <?php require "admin__left_menu.php";?>
        <div class="mainContent">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-10 p-0 m-5 ">
                        <div class="container">
    <div style="margin-top: 2rem;">
        <div class="row">
            <div class="col">
                <div class="alert alert-primary" role="alert" id="info-bar" style="display: none"></div>
            </div>
        </div>
        <div class="container mt-4">
            <div class="card" style="width: 50rem;">
                <div class="card-body">
                    <h5 class="card-title">聯絡資訊</h5>
                    <form name="form1" onsubmit="return checkForm()">
                        <input type="hidden" name="sid" value="<?=$row['sid']?>">
                        <table class="table table-hover">
                            <tr>
                                <th>
                                    <label for="email">電子信箱</label>
                                </th>
                                <td>
                                    <input type="text" name="email" id="email" value="<?=$row['email']?>">
                                    <a href="" id="addBtn_1"><i class="fas fa-plus"></i></a>
                                    <input type="<?=!empty($row['alt_email']) ? 'text' : 'hidden'?>" name="alt_email" id="alt_email" value="<?=$row['alt_email']?>">
                                    <a href="" style="<?=!empty($row['alt_email']) ? 'display:inline-block' : 'display: none'?>" id="removeBtn_1"><i class="fas fa-minus"></i></a>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>
                                    <label for="teacher_phone">聯絡電話</label>
                                </th>
                                <td>
                                    <input type="text" name="teacher_tel" id="teacher_tel" value="<?=$row['teacher_tel']?>">
                                    <a href="" id="addBtn_2"><i class="fas fa-plus"></i></a>
                                    <input type="<?=!empty($row['alt_tel']) ? 'text' : 'hidden'?>" name="alt_tel" id="alt_tel" value="<?=$row['alt_tel']?>">
                                    <a href="" style="<?=!empty($row['alt_tel']) ? 'display:inline-block' : 'display: none'?>" id="removeBtn_2"><i class="fas fa-minus"></i></a>
                                </td>
                                <td></td>
                            </tr>
                        </table>
                        <button type="submit" class="btn btn-primary" id="submit_btn">修改</button>
                        <a href="info.php"><div type="submit" class="btn btn-light" id="">取消</div></a>
                </div>
                </form>
            </div>
    </div>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>



        <script>
            // email + -
            let addBtn_1 = document.querySelector('#addBtn_1');
            let removeBtn_1 = document.querySelector('#removeBtn_1');
            let input_1 = document.querySelector('#alt_email');
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
                    input_1.value = "<?=$row['alt_email'] = ''?>";
                }
            })
            // tel + -

            let addBtn_2 = document.querySelector('#addBtn_2');
            let removeBtn_2 = document.querySelector('#removeBtn_2');
            let input_2 = document.querySelector('#alt_tel');
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
                    input_2.value = "<?=$row['alt_phone'] = ''?>";
                }
            })
            //
            let info_bar = document.querySelector('#info-bar');

            function checkForm() {
                let fd = new FormData(document.form1);
                fetch('admin_teacher_edit_api_2.php', {
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
                                 location.href = 'admin_teacher_edit.php?sid=' + <?=$sid?>;
                             }, 1000);
                        } else {
                            info_bar.className = 'alert alert-danger';
                        }
                    });
                return false;
            }
        </script>

    <?php require 'admin__footer.php'?>