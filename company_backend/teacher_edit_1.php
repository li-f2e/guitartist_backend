<?php
require '__admin_required.php';
require '__connect_db.php';

$sql = "SELECT * FROM `member_list` WHERE  `email` = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['loginUser']['email']]);
$row = $stmt->fetch();

?>
<?php 
require '__header.php';
require_once __DIR__ . "/teacher__nav_bar.php";
?>



 

<?php require_once __DIR__ . "/teacher__nav_bar.php"; ?>

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
            <div class="card" style="width: 50rem;">
                <div class="card-body">
                    <h5 class="card-title">廠商資料</h5>
                    <form name="form1" onsubmit="return checkForm()">
                        <input type="hidden" name="email" value="<?= $row['email'] ?>">
                        <table class="table table-hover">
                            <tr>
                                <th>照片</th>
                                <td>
                                    <!-- 原圖 -->
                                    <img style="width:200px" class="pic" src="uploads/<?=$row['pic']?>" alt="">
                                    <!-- 修改圖 -->
                                    <div class="form-group">
                                        <!-- <label for="my_file" display="none">選擇上傳的圖檔</label> -->
                                        <input type="file" class="form-control-file" id="my_file" name="my_file"  onchange="previewFile()">               
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <th><label for="name">名字</label></th>
                                <td><?= $row['name'] ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th><label for="teacher_birthday">生日</label></th>
                                <td><input type="text" name="teacher_birthday" id="teacher_	teacher_birthday" value="<?= $row['teacher_birthday'] ?>"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th><label for="teacher_introduction">自我介紹</label></th>
                                <td><input type="text" name="teacher_introduction" id="teacher_introduction" value="<?= $row['teacher_introduction'] ?>"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th><label for="teacher_specialty">特殊專長</label></th>
                                <td><input type="text" name="teacher_specialty" id="teacher_specialty" value="<?= $row['teacher_specialty'] ?>"></td>
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
                fetch('teacher_edit_api_1.php', {
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