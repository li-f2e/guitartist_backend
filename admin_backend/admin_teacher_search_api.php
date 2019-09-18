<?php
require '__admin_required.php';
require 'init.php';
if (isset($_POST['search'])) {
// if($_POST['search']!=''){
    $search = "";
    $stmt = $pdo->query("SELECT * FROM `member_list` WHERE `is_teacher`=1 AND `name` like '%%' ");

} else {
    $stmt = $pdo->query("SELECT * FROM `member_list` WHERE `is_teacher`=1");
}

// $r = $stmt->fetch();

// $rows = $stmt->fetchAll();

include 'admin__header.php';
include 'admin__nav_bar.php';

?>



<div class="wrapper d-flex">

        <?php require_once __DIR__ . "/admin__left_menu.php";?>

            <div class="mainContent">
                <div class="container-fluid">
                    <div class="row justify-content-start">
                        <div class="col-10 p-0 mt-5 ml-3 ">
                             <div style="margin-top: 2rem;">

                            <form name="form2"  onsubmit="return Search() " action="">

                            <label for="">輸入想搜尋的姓名: </label>
                            <input type="text" name="search" id="search">
                            <button>搜尋</button>

                            </form>


                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">名稱</th>
                                    <th scope="col">照片</th>
                                    <th scope="col">電子郵箱</th>
                                    <th scope="col">聯絡電話</th>
                                    <th scope="col">生日</th>
                                    <th scope="col">教學經歷</th>
                                    <th scope="col">表演經歷</th>


                                    <th scope="col">專長</th>
                                    <!-- <th scope="col">作品影音</th> -->
                                    <th scope="col"><i class="fas fa-trash-alt"></i></th>
                                    <th scope="col"><i class="fas fa-edit"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php while ($r = $stmt->fetch()) {?>
                                   <!-- <form name="form1" onsubmit="return checkForm()">                                     -->
                                <tr>
                                    <td><?=$r['sid']?></td>
                                    <td><?=$r['teacher_name']?></td>
                                    <td> <img src="uploads/<?=$r['teacher_pic']?>" class="pic" alt=""></td>
                                    <td><?=$r['email']?></td>
                                    <td><?=$r['teacher_tel']?></td>
                                    <td><?=$r['teacher_birthday']?></td>
                                    <td><?=$r['teacher_experience']?></td>
                                    <td><?=$r['teacher_perform']?></td>


                                    <td><?=$r['teacher_specialty']?></td>
                                    <!-- <td><?php // echo $r['teacher_music'] ?></td> -->
                                    <td>
                                        <a href="javascript:delete_one(<?=$r['sid']?>)"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                    <td>
                                        <a href="admin_teacher_edit.php?sid=<?=$r['sid']?>"><i class="fas fa-edit"></i></a>
                                        <!-- <a href="javascript:loadData(<%=%>)"><i class="fas fa-edit"></i></a> -->

                                    </td>
                                </tr>
                                    <?php }?>
                            <!-- </form> -->
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





    <script>
    function delete_one(sid) {
            if(confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)){
                location.href = 'data_delete.php?sid=' + sid;
            }
        }

    //傳送
    function Search() {
                let fd = new FormData(document.form1);
                fetch('admin_teacher_search_api.php', {
                        method: 'POST',
                        body: fd,
                    })
                    .then(response => {
                        return response.json();
                    })
                    .then(json => {
                        console.log(json);
                    });
                return false;
            }

    </script>




<?php include 'admin__footer.php';?>