<?php
require '__admin_required.php';
require 'init.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "SELECT * FROM `member_list` WHERE `sid`=$sid ";
$stmt = $pdo->query($sql);
$row = $stmt->fetch();

?>

<?php
require 'admin__header.php';
require "admin__nav_bar.php";
?>

<div class="wrapper d-flex">

        <?php require_once __DIR__ . "/admin__left_menu.php";?>
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
                    <h5 class="card-title">吉他生涯</h5>
                    <form name="form1" onsubmit="return checkForm()">
                        <input type="hidden" name="email" value="<?=$row['email']?>">
                        <table class="table table-hover">
                            <tr>
                                <th><label for="bank_acc">教學經歷</label></th>
                                <td><input type="text" name="teacher_experience" id="teacher_experience" value="<?=$row['teacher_experience']?>"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th><label for="bank_acc_num">表演經歷</label></th>
                                <td><input type="text" name="teacher_perform" id="teacher_perform" value="<?=$row['teacher_perform']?>"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th><label for="bank_acc_num">得獎紀錄</label></th>
                                <td><input type="text" name="teacher_award" id="teacher_award" value="<?=$row['teacher_award']?>"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th><label for="teacher_music">作品影音</label></th>

                                <div class="d-flex flex-column">
                                <td id="video" style="display:block;"><?=$row['teacher_music']?></td>



                                <td style="display:block;">請在以下欄位輸入YOUTUBE連結 </td>
                                <td style="display:block;border:0;"><input type="text" name="teacher_music" id="teacher_music" onchange="videochange()"></td>
                                </div>
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
            let info_bar = document.querySelector('#info-bar');

            //影片
            let video = document.querySelector('#video');
            let teacher_music = document.querySelector('#teacher_music');


            function videochange(){
                // alert('hohohoho')
                video.innerHTML = teacher_music.value;

            }

            function checkForm() {
                let fd = new FormData(document.form1);
                fetch('admin_teacher_edit_api_3.php', {
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