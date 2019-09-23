<?php
require '__admin_required.php';
require 'init.php';

$sql = "SELECT * FROM `member_list` WHERE  `email` = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['loginUser']['email']]);
$row = $stmt->fetch();

?>
<?php 
require '__header.php';
require_once __DIR__ . "/teacher__nav_bar.php";
?>



 



    <div class="wrapper d-flex">
        
    <?php require_once __DIR__ . "/teacher__left_menu.php"; ?>
    
        <div class="mainContent">
            <div class="container-fluid">
                <div class="row justify-content-start">
                    <div class="col-10 p-0 mt-5 ml-3 ">
                    <div class="container">
    <div style="margin-top: 2rem;">
        <div class="row">
            <div class="col">
                <div class="alert alert-primary" role="alert" id="info-bar" style="display: none"></div>
            </div>
        </div>
        <div class="container mt-4">
            <div class="card" style="width: 60rem;">
                <div class="card-body">
                    <h5 class="card-title">吉他生涯</h5>
                    <form name="form1" onsubmit="return checkForm()">
                        <input type="hidden" name="email" value="<?= $row['email'] ?>">
                        <table class="table table-hover">
                            
                            <tr>
                                <th><label for="teacher_experience">教學經歷</label></th>
                                <td><input type="text" name="teacher_experience" id="teacher_experience" value="<?= $row['teacher_experience'] ?>"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th><label for="teacher_perform">表演經歷</label></th>
                                <td><input type="text" name="teacher_perform" id="teacher_perform" value="<?= $row['teacher_perform'] ?>"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th><label for="teacher_award">得獎紀錄</label></th>
                                <td><input type="text" name="teacher_award" id="teacher_award" value="<?= $row['teacher_award'] ?>"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th><label for="teacher_music">作品影音</label></th>

                                <div class="d-flex flex-column">
                                <td id="video" style="display:block;"><?= $row['teacher_music'] ?></td>
                                
                                
                                
                                <!--<td>請在以下欄位輸入YOUTUBE連結--> 
                                <td style="display:block;border:0;"><input type="text" name="teacher_music" id="teacher_music" value="請在欄位輸入YOUTUBE連結" onchange="videochange()"></td>
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




            // 圖片顯示
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

            //JORDAN
            let addBtn_1 = document.querySelector('#addBtn_1');
            let removeBtn_1 = document.querySelector('#removeBtn_1');
            let input_1 = document.querySelector('#brand_2');
            let input_2 = document.querySelector('#brand_3');

            addBtn_1.addEventListener('click', function(e) {
                e.preventDefault();
                input_1.setAttribute('type', 'text');
                removeBtn_1.style = 'block';
                if(input_1.value != '' && input_2.value == ''){
                    input_2.setAttribute('type', 'text');
                    removeBtn_2.style = 'block';
                }
            })

            removeBtn_1.addEventListener("click", function(e) {
                if (confirm('確定要刪除這筆資料嗎?')) {
                    e.preventDefault();
                    input_1.setAttribute('type', 'hidden');
                    removeBtn_1.style.display = "none";
                    input_1.value = "<?=$row['brand_2'] = ''?>";
                }
            })

            removeBtn_2.addEventListener("click", function(e) {
                if (confirm('確定要刪除這筆資料嗎?')) {
                    e.preventDefault();
                    input_2.setAttribute('type', 'hidden');
                    removeBtn_2.style.display = "none";
                    input_2.value = "<?=$row['brand_3'] = ''?>";
                }
            })

            //

            //連資料庫
            function checkForm() {
                let fd = new FormData(document.form1);
                fetch('teacher_edit_api_3.php', {
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
                                location.href = 'teacher_info.php'; 
                            }, 1000);
                        } else {
                            location.href = 'teacher_info.php'
                            info_bar.className = 'alert alert-danger';
                        }
                    });
                return false;
            }
        </script>


        
    </div>
    <?php require '__footer.php' ?>