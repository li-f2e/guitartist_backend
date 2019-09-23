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
<style>
  .table th {
    width: 20%;
  }

  .table td {
    vertical-align: middle;
    color: #6c757d;
  }

  .breadcrumb-item a{
        color: rgb(226, 24, 24);
    }

</style>

<!-------左方欄位--------->

<div  class="wrapper d-flex">
<?php
require_once __DIR__ . "/admin__left_menu.php";
?>



<!-------右方輸入列--------->

<div class="mainContent mainContent-css">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-11 mt-5 mx-auto">
                    <div class="container">
                        <div style="margin-top: 2rem;">
                            <div class="row">
                                <div class="col">
                                    <div class="alert alert-primary" role="alert" id="info-bar" style="display: none">
                                    </div>
                                </div>
                            </div>
                            <!-- 麵包屑 -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-3 p-1">
                                    <li class="breadcrumb-item"><a href="admin_teacher_list.php">老師列表</a></li>
                                    <li class="breadcrumb-item"><a href="admin_teacher_edit.php?sid=<?= $row['sid'] ?>">編輯老師資訊</a></li>
                                    <li class="breadcrumb-item active font-weight-bold" aria-current="page">編輯基本資訊</li>
                                </ol>
                            </nav>
                            <div class="card edit_card">
                                <div class="card-body">
                                    <h5 class="card-title">基本資訊</h5>
                                    <form name="form1" onsubmit="return checkForm()">
                                        <input type="hidden" name="sid" value="<?=$row['sid']?>">
                                        <table class="table table-hover">
                                            <tr>
                                                <th>照片</th>
                                                <td>
                                                    <!-- 原圖 -->
                                                    <img class="pic" src="uploads/<?=$row['teacher_pic']?>" alt="">
                                                    <!-- 修改圖 -->
                                                    <div class="form-group">
                                                        <!-- <label for="my_file" display="none">選擇上傳的圖檔</label> -->
                                                        <input type="file" class="form-control-file" id="my_file"
                                                            name="my_file" onchange="previewFile()">
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th><label for="teacher_name">名字</label></th>
                                                <td><input type="text" name="teacher_name" id="teacher_name"
                                                        value="<?=$row['teacher_name']?>"></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th><label for="password">密碼</label></th>
                                                <td><input type="password" name="password" id="password"
                                                        value="<?=$row['password']?>"></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th><label for="teacher_birthday">生日</label></th>
                                                <td><input type="text" name="teacher_birthday"
                                                        id="teacher_	teacher_birthday"
                                                        value="<?=$row['teacher_birthday']?>"></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th><label for="teacher_introduction">自我介紹</label></th>
                                                <td><input type="text" name="teacher_introduction"
                                                        id="teacher_introduction"
                                                        value="<?=$row['teacher_introduction']?>"></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th><label for="teacher_specialty">特殊專長</label></th>
                                                <td><input type="text" name="teacher_specialty" id="teacher_specialty"
                                                        value="<?=$row['teacher_specialty']?>"></td>
                                                <td></td>
                                            </tr>
                                        </table>
                                        <div class="mr-auto mt-4 d-flex" style="width:130px">
                                            <button type="submit" class="btn btn-dark" id="submit_btn">修改</button>
                                            <a href="admin_teacher_edit.php">
                                                <div class="btn btn-light ml-2" id="">取消</div>
                                            </a>
                                        </div>
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
            // let addBtn_1 = document.querySelector('#addBtn_1');
            // let removeBtn_1 = document.querySelector('#removeBtn_1');
            // let input_1 = document.querySelector('#brand_2');
            // let input_2 = document.querySelector('#brand_3');

            // addBtn_1.addEventListener('click', function(e) {
            //     e.preventDefault();
            //     input_1.setAttribute('type', 'text');
            //     removeBtn_1.style = 'block';
            //     if(input_1.value != '' && input_2.value == ''){
            //         input_2.setAttribute('type', 'text');
            //         removeBtn_2.style = 'block';
            //     }
            // })

            // removeBtn_1.addEventListener("click", function(e) {
            //     if (confirm('確定要刪除這筆資料嗎?')) {
            //         e.preventDefault();
            //         input_1.setAttribute('type', 'hidden');
            //         removeBtn_1.style.display = "none";
            //         input_1.value = "<?//=$row['brand_2'] = ''?>";
            //     }
            // })

            // removeBtn_2.addEventListener("click", function(e) {
            //     if (confirm('確定要刪除這筆資料嗎?')) {
            //         e.preventDefault();
            //         input_2.setAttribute('type', 'hidden');
            //         removeBtn_2.style.display = "none";
            //         input_2.value = "<?//=$row['brand_3'] = ''?>";
            //     }
            // })

            //

            //連資料庫
            function checkForm() {
                let fd = new FormData(document.form1);
                fetch('admin_teacher_edit_api_1.php', {
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
                                location.href = 'admin_teacher_edit.php?sid=' + <?=$sid?>;
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
                return false;
            }
        </script>
    </div>
    <?php require 'admin__footer.php'?>